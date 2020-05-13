<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>決算報告</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="2">
              <v-select :items="periods" v-model="periodSelected" label="決算期"></v-select>
            </v-col>
          </v-row>
          <div>決算日：　2020年5月10日</div>
          <div class="mt-2">
            報告者：
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left>
                <v-icon>mdi-account-circle</v-icon>
              </v-avatar>201 田中（会計）
            </v-chip>
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left>
                <v-icon>mdi-account-circle</v-icon>
              </v-avatar>202 鈴木（会計）
            </v-chip>
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left>
                <v-icon>mdi-account-circle</v-icon>
              </v-avatar>203 岡本（監査）
            </v-chip>
          </div>
          <monthly-fee></monthly-fee>
          <income-table></income-table>
          <expenditure-table></expenditure-table>
          <assets-table></assets-table>
          <account-table></account-table>
          <!-- <total-balance-table></total-balance-table> -->
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      periods: ["2020年05月期", "2020年06月期", "2020年07月期"],
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
