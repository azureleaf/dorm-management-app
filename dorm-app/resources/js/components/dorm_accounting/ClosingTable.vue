<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>決算報告</v-card-title>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <v-btn
                color="error"
                depressed
                absolute
                right
                :disabled="hasPendingReport || !isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>決算報告の新規作成（寮大前）
              </v-btn>
            </v-col>
          </v-row>
          <v-row class="pb-5">
            <v-col>
              <v-btn
                color="error"
                depressed
                absolute
                right
                :disabled="!hasPendingReport || isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>決算を確定し寮費請求（寮大後）
              </v-btn>
            </v-col>
          </v-row>
          <v-row class="pb-5">
            <v-col>
              <v-btn
                color="error"
                depressed
                absolute
                right
                :disabled="!hasPendingReport || !isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>引落依頼CSVデータ生成（寮大後）
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-select :items="periods" v-model="periodSelected" label="決算期" outlined></v-select>
            </v-col>
          </v-row>

          <div>決算日： 2020年5月10日</div>
          <div>寮生大会承認日： 承認待ち</div>
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
          <deduction-table></deduction-table>
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
      periodShown: "",
      hasPendingReport: false,
      isBillingDone: true,
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
    periodSelected: {
      get: function() {
        return this.periods[this.periods.length - 1];
      },
      set: function(newVal) {
        this.periodShown = newVal;
      }
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
