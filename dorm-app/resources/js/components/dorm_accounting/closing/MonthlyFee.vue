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
        <template v-slot:item.total_amount="{}">
          {{ formatCurrency(feeprop.total_amount) }}
        </template>
        <template v-slot:item.persons_after_deduction="{}">
          {{ feeprop.persons_after_deduction }}
        </template>
        <template v-slot:item.quotient="{}">
          {{
            (feeprop.total_amount / feeprop.persons_after_deduction).toFixed(2)
          }}
        </template>
        <template v-slot:item.fee="{}">
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
                  (
                    feeprop.total_amount / feeprop.persons_after_deduction
                  ).toFixed(2)
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
  props: ["feeprop"],
  data: function() {
    return {
      funds: [
        {
          total_amount: "",
          persons_after_deduction: "",
          quotient: "",
          fee: ""
        }
      ],
      fundHeaders: [
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
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
