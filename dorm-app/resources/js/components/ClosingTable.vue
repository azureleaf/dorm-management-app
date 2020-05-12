<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>決算</v-card-title>
        <v-card-text>
          <p>報告者：201 田中太郎（会計委員）, 202 鈴木太郎（会計委員）, 203 岡本太郎（監査委員）</p>
          <v-row>
            <v-col cols="2">
              <v-select :items="periods" v-model="periodSelected" label="決算期"></v-select>
            </v-col>
          </v-row>
          <monthly-fee></monthly-fee>
          <income-table></income-table>
          <expenditure-table></expenditure-table>
          <assets-table></assets-table>
          <account-table></account-table>
          <total-balance-table></total-balance-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      periods: ["2020-05", "2020-06", "2020-07"],
      billItems: [],
      billingHeaders: [
        {
          text: "寮会計処理ID",
          sortable: true,
          value: "id"
        },
        {
          text: "処理登録日",
          sortable: true,
          value: "created_at"
        },
        {
          text: "区分",
          sortable: true,
          value: "category"
        },
        {
          text: "摘要",
          sortable: true,
          value: "abstract"
        },
        {
          text: "収入",
          sortable: true,
          value: "billing"
        },
        {
          text: "支出",
          sortable: true,
          value: "payment"
        },

        {
          text: "残高",
          sortable: true,
          value: "balance"
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
    console.log("Component mounted.");
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
