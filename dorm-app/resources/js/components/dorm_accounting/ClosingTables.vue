<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮会計基本金</span>
          <v-spacer></v-spacer>
          <v-btn
            color="error"
            depressed
            absolute
            right
            :disabled="hasPendingReport || !isBillingDone"
          >
            <v-icon class="mr-1">mdi-plus-circle</v-icon>新しい決算期の追加
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-divider></v-divider>

          <v-card class="d-flex" flat tile>
            <v-row class="mt-2">
              <v-col cols="12" md="6">
                <v-select
                  :items="periods"
                  v-model="periodIndexInFees"
                  item-text="text"
                  item-value="indexInFees"
                  label="決算期"
                  outlined
                  @change="showClosing"
                ></v-select>
              </v-col>
              <v-col> </v-col>
            </v-row>
            <v-card tile flat class="ml-auto my-3">
              <v-btn
                color="error"
                depressed
                :disabled="hasPendingReport || !isBillingDone"
              >
                <v-icon class="mr-1">mdi-calendar-month</v-icon>決算日の設定
              </v-btn>
              <v-btn
                color="error"
                depressed
                :disabled="!hasPendingReport || isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>各寮生への請求処理
              </v-btn>
            </v-card>
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
          <monthly-fee :feeDetails="feeDetails"></monthly-fee>
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
      periods: [],
      // Index of the period selected in fees[]
      // The first period is the latest, supposedly
      periodIndexInFees: 0,
      hasPendingReport: false,
      isBillingDone: true,
      fees: []
    };
  },
  computed: {
    feeDetails: {
      get: async function() {
        await this.loadFees();
        console.log(this.fees[this.periodIndexInFees]);
        return this.fees[this.periodIndexInFees];
      }
    }
  },
  methods: {
    // Load from DB, set fees[]
    async loadFees() {
      const res = await axios.get("./monthly-fees");
      this.fees = res.data;
      this.fees.map((fee, index) => {
        this.periods.push({ text: fee.closing_name, indexInFees: index });
      });
    },
    showClosing() {
      // Set props to be passed to the component
      this.feeDetails = this.fees[this.periodIndexInFees];
    }
  },
  mounted: async function() {
    await this.loadFees();
  }
};
</script>
<style scoped></style>
