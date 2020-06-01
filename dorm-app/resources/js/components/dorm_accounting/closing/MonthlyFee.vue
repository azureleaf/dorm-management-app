<template>
  <v-card outlined class="mb-4">
    <v-card-title>基本金</v-card-title>
    <v-card-subtitle>翌月の寮生ひとりあたりの徴収予定額です。</v-card-subtitle>
    <v-card-text>
      <v-data-table
        :headers="fundHeaders"
        :items="funds"
        :items-per-page="funds.length"
        hide-default-footer
      ></v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      funds: [
        {
          type: "一般会計",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "罰金会計",
          burden_rate: "0.25",
          persons: "2",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "コンパ会計",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "設備投資会計",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },

        {
          type: "合計",
          burden_rate: "",
          persons: "60",
          persons_deducted: "",
          start_at: "",
          end_at: "",
          comment: ""
        }
      ],
      fundHeaders: [
        {
          text: "会計区分",
          sortable: false,
          value: "type"
        },
        {
          text: "積立期間",
          sortable: false,
          value: ""
        },
        {
          text: "既定額",
          sortable: false,
          value: ""
        },
        {
          text: "均等徴収額合計",
          sortable: false,
          value: ""
        },
        {
          text: "負担人数",
          sortable: false,
          value: ""
        },
        {
          text: "除算結果",
          sortable: false,
          value: ""
        },
        {
          text: "基本金内訳（切り上げ）",
          sortable: false,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
