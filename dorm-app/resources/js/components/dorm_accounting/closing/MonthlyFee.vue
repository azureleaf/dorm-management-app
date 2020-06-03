<template>
  <v-card outlined class="my-5">
    <v-card-title
      >基本金<v-spacer></v-spacer>
      <v-btn color="error" depressed absolute right>
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>徴収総額の編集
      </v-btn></v-card-title
    >
    <v-card-text>
      <v-data-table
        :headers="fundHeaders"
        :items="funds"
        :items-per-page="funds.length"
        hide-default-footer
      >
        <template v-slot:item.total_amount="{ item }">
          {{ formatCurrency(item.total_amount) }}
        </template>
        <template v-slot:item.quotient="{ item }">
          {{ (item.total_amount / item.persons_after_deduction).toFixed(2) }}
        </template>
        <template v-slot:item.fee="{ item }">
          <v-chip
            color="primary"
            outlined
            large
            label
            class="my-1 font-weight-bold"
          >
            {{
              formatCurrency(
                Math.ceil(
                  (item.total_amount / item.persons_after_deduction).toFixed(2)
                )
              )
            }}
          </v-chip>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["feeDetailsPromise"],
  data: function() {
    return {
      funds: [
        {
          type: "一般会計",
          total_amount: "",
          persons_after_deduction: "",
          quotient: "",
          fee: ""
        }
        // {
        //   type: "罰金会計",
        //   burden_rate: "0.25",
        //   persons: "2",
        //   persons_after_deduction: "0.5",
        //   start_at: "",
        //   end_at: "",
        //   comment: ""
        // },
        // {
        //   type: "コンパ会計",
        //   burden_rate: "0.5",
        //   persons: "1",
        //   persons_after_deduction: "0.5",
        //   start_at: "",
        //   end_at: "",
        //   comment: ""
        // },
        // {
        //   type: "設備投資会計",
        //   burden_rate: "0.5",
        //   persons: "1",
        //   persons_after_deduction: "0.5",
        //   start_at: "",
        //   end_at: "",
        //   comment: ""
        // },

        // {
        //   type: "合計",
        //   burden_rate: "",
        //   persons: "60",
        //   persons_after_deduction: "",
        //   start_at: "",
        //   end_at: "",
        //   comment: ""
        // }
      ],
      fundHeaders: [
        // {
        //   text: "会計区分",
        //   sortable: false,
        //   value: "type"
        // },
        // {
        //   text: "積立期間",
        //   sortable: false,
        //   value: ""
        // },
        // {
        //   text: "既定額",
        //   sortable: false,
        //   value: ""
        // },
        {
          text: "徴収総額",
          sortable: false,
          value: "total_amount"
        },
        {
          text: "負担人数",
          sortable: false,
          value: "persons_after_deduction"
        },
        {
          text: "除算結果",
          sortable: false,
          value: "quotient"
        },
        {
          text: "基本金（切り上げ）",
          sortable: false,
          value: "fee"
        }
      ]
    };
  },
  mounted: async function() {
    const feeDetails = await this.feeDetailsPromise;
    this.funds[0].total_amount = feeDetails.total_amount;
    this.funds[0].persons_after_deduction = feeDetails.persons_after_deduction;
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
