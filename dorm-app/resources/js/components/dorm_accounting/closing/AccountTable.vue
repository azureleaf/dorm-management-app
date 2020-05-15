<template>
  <v-card outlined class="mb-4">
    <v-card-title>会計別収支</v-card-title>
    <v-card-text>
      <v-row class="pb-5">
        <v-col>
          <v-btn color="error" depressed absolute right>
            <v-icon class="mr-1">mdi-security</v-icon>会計別収支の登録
          </v-btn>
        </v-col>
      </v-row>
      <v-data-table :headers="accountHeaders" :items="accounts" :items-per-page="20"></v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      accounts: [
        {
          name: "一般会計",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "コンパ積立金",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "通信設備積立金",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "2020-01",
          end_at: "2021-12"
        },
        {
          name: "罰金会計",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "合計額（D）",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345"
        }
      ],
      accountHeaders: [
        {
          text: "会計区分",
          sortable: true,
          value: "name"
        },
        {
          text: "開始年月",
          sortable: true,
          value: "start_at"
        },
        {
          text: "終了年月",
          sortable: true,
          value: "end_at"
        },
        {
          text: "期首残高",
          sortable: true,
          value: "beginningBalance"
        },
        {
          text: "収入額",
          sortable: true,
          value: "income"
        },
        {
          text: "支出額",
          sortable: true,
          value: "expenditure"
        },
        {
          text: "期末残高",
          sortable: true,
          value: "finalBalance"
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
</style>
