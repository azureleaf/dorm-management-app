<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title>決算</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="2">
              <v-select :items="periods" v-model="periodSelected" label="決算期"></v-select>
            </v-col>
          </v-row>
          <v-card outlined>
            <v-card-title>基本金</v-card-title>
            <v-card-subtitle>翌月の各寮生からの徴収額です。</v-card-subtitle>
            <v-card-text>
              <p>12,345</p>
              <p>委員会免除分</p>
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
            </v-card-text>
          </v-card>

         
          <income-table></income-table>
          <expenditure-table></expenditure-table>
          <v-card outlined>
            <v-card-title>資産内訳</v-card-title>
            <v-card-text>
              滞納者未払金, 他寮未払金
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
            </v-card-text>
          </v-card>
          <v-card outlined>
            <v-card-title>会計別残高</v-card-title>
            <v-card-text>
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
            </v-card-text>
          </v-card>
          <v-card outlined>
            <v-card-title>総収支</v-card-title>
            <v-card-text>
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
            </v-card-text>
          </v-card>
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
