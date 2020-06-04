<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>{{ feeComp.closing_name }}寮費請求</span>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            depressed
            :disabled="hasPendingReport || !isBillingDone"
          >
            <v-icon class="mr-1">mdi-plus-circle</v-icon>決算期追加
          </v-btn>
          <v-btn
            color="error"
            depressed
            :disabled="hasPendingReport || !isBillingDone"
          >
            <v-icon class="mr-1">mdi-square-edit-outline</v-icon>決算日設定
          </v-btn>
          <v-btn
            color="error"
            depressed
            :disabled="!hasPendingReport || isBillingDone"
          >
            <v-icon class="mr-1">mdi-security</v-icon>寮費請求
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-card class="d-flex mt-5 font-weight-bold" flat tile>
            <v-chip label outlined color="green darken-2" class="mr-2" dark>
              決算日：{{ feeComp.closed_at }}
            </v-chip>
            <v-chip label outlined color="grey darken-1" class="mr-2"> 承認日：寮生大会未承認 </v-chip>
          </v-card>
          <!-- <v-row class="pb-5">
            <v-col>
              <v-btn
                color="error"
                depressed
                absolute
                right
                :disabled="!hasPendingReport || !isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>引落依頼情報の生成
              </v-btn>
            </v-col>
          </v-row> -->
          <!-- <div class="mt-2">
            報告者：
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left> <v-icon>mdi-account-circle</v-icon> </v-avatar>201
              田中（会計）
            </v-chip>
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left> <v-icon>mdi-account-circle</v-icon> </v-avatar>202
              鈴木（会計）
            </v-chip>
            <v-chip class="ma-1" color="grey" text-color="white" label>
              <v-avatar left> <v-icon>mdi-account-circle</v-icon> </v-avatar>203
              岡本（監査）
            </v-chip>
          </div> -->
          <monthly-fee :feeprop="feeComp"></monthly-fee>
          <deduction-table></deduction-table>
          <collection-result-table></collection-result-table>
          <reward-and-penalty-table></reward-and-penalty-table>
          <!-- <account-table></account-table> -->
          <!-- <income-table></income-table> -->
          <!-- <expenditure-table></expenditure-table> -->
          <!-- <assets-table></assets-table> -->
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
      hasPendingReport: false,
      isBillingDone: true,
      fees: []
    };
  },
  computed: {
    // To suppress error of "Cannot read property xxx of undefined",
    // don't try to read deep layer values when the fees[] obj isn't loaded yet
    feeComp() {
      return this.fees.length == 0 ? "" : this.fees[0];
    }
  },
  methods: {
    // Load from DB, set fees[]
    // ASSUMPTION: axios result is ordered by the date of closing; the latest is the first
    async loadFees() {
      const res = await axios.get("./monthly-fees");
      this.fees = res.data;
    }
  },
  async mounted() {
    this.loadFees();
    // this.fees = await this.loadFees();
    // console.log(this.feeIdSelected);
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle !important;
}
</style>
