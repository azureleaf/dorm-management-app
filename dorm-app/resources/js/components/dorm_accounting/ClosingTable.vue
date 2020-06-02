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
          <v-row>
            <v-col cols="12" md="4">
              <v-select
                :items="periods"
                v-model="periodSelected"
                label="決算期"
                outlined
              ></v-select>
            </v-col>
            <v-spacer></v-spacer>
            <v-col>
              <v-btn
                color="error"
                depressed
                absolute
                right
                :disabled="!hasPendingReport || isBillingDone"
              >
                <v-icon class="mr-1">mdi-security</v-icon>各寮生への請求処理
              </v-btn>
            </v-col>
          </v-row>
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
          <v-subheader>決算日： 2020年5月10日</v-subheader>
          <v-subheader>寮生大会承認日： 承認待ち</v-subheader>
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
          <monthly-fee></monthly-fee>
          <deduction-table></deduction-table>
          <collection-result-table></collection-result-table>
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
      periods: ["2020年05月期", "2020年06月期", "2020年07月期"],
      periodShown: "",
      hasPendingReport: false,
      isBillingDone: true
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
  }
};
</script>
<style scoped>
</style>
