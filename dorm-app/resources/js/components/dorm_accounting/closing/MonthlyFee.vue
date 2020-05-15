<template>
  <v-card outlined class="mb-4">
    <v-card-title>基本金</v-card-title>
    <v-card-subtitle>翌月の各寮生からの徴収予定額です。</v-card-subtitle>
    <v-card-text>
      <v-row class="pb-5 mb-2">
        <v-col>
          <v-btn color="error" depressed absolute right>
            <v-icon class="mr-1">mdi-security</v-icon>負担人数の編集
          </v-btn>
        </v-col>
      </v-row>
      <v-card class="pa-3 formula" flat outlined>
        <v-chip outlined label large color="green darken-2">一般会計支出： 200000</v-chip>
        <span class="display-1">÷</span>
        <v-chip outlined label large color="green darken-2">負担人数： 45.2</v-chip>
        <span class="display-1">=</span>
        <v-chip outlined label large color="red">寮費（端数切り上げ）： 12345</v-chip>
      </v-card>
      <v-data-table
        :headers="payerTypeHeaders"
        :items="payerTypes"
        :items-per-page="payerTypes.length"
        hide-default-footer
      ></v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      payerTypes: [
        {
          type: "委員長",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "副委員長",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "総務",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "会計委員",
          burden_rate: "0.25",
          persons: "2",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "会計委員（臨時代理）",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "2020-06",
          end_at: "2020-09",
          comment: ""
        },
        {
          type: "一般寮生",
          burden_rate: "1",
          persons: "54",
          persons_deducted: "50",
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
      payerTypeHeaders: [
        {
          text: "職名",
          sortable: false,
          value: "type"
        },
        {
          text: "負担率",
          sortable: false,
          value: "burden_rate"
        },
        {
          text: "実人数",
          sortable: false,
          value: "persons"
        },
        {
          text: "負担人数",
          sortable: false,
          value: "persons_deducted"
        },
        {
          text: "開始月",
          sortable: false,
          value: "start_at"
        },
        {
          text: "終了月",
          sortable: false,
          value: "end_at"
        }
      ]
    };
  },
  computed: {
    periodSelected() {
      return this.periods[this.periods.length - 1];
    }
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
