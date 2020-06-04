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
            <v-chip label outlined color="grey darken-1" class="mr-2">
              承認日：寮生大会未承認
            </v-chip>
          </v-card>
          <monthly-fee
            :personsprop="personsAfterDeduction"
            :totalamountprop="feeComp.total_amount"
            :feeid="feeComp.id"
          ></monthly-fee>
          <deduction-table
            @updateDeduction="onDeductionUpdate"
          ></deduction-table>
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
      personsAfterDeduction: null, // will be calculated by child component
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
    },
    onDeductionUpdate(newPersons) {
      this.personsAfterDeduction = newPersons;
    }
  },
  async mounted() {
    this.loadFees();
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle !important;
}
</style>
