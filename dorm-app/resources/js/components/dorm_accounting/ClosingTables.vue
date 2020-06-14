<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮費請求原稿</span>
          <v-spacer></v-spacer>
          <closing-tables-dialog
            v-if="!hasSessionStorage"
            @setClosingDate="createDraft"
          ></closing-tables-dialog>
          <v-btn
            v-else
            color="error"
            depressed
            class="mx-1"
            @click="initParams"
          >
            <v-icon class="mr-1">mdi-close-circle</v-icon>作成中の請求原稿を破棄
          </v-btn>
        </v-card-title>
        <v-card-text v-if="hasSessionStorage">
          <v-row>
            <v-spacer></v-spacer>
            <v-card flat>
              <v-card-text>
                <v-chip
                  v-if="hasSessionStorage"
                  label
                  outlined
                  color="green darken-2"
                  class="px-4 ml-4 font-weight-bold"
                  large
                  dark
                >
                  決算日：{{ readDraft().closingDate }}
                </v-chip>
              </v-card-text>
            </v-card>
          </v-row>
          <monthly-fee
            v-if="persons.beforeDeduction"
            :personsprop="persons"
            @updateMonthlyFee="onMonthlyFeeUpdate"
          ></monthly-fee>
          <deduction-table
            v-if="hasSessionStorage"
            :closingdate="readDraft().closingDate"
            @updateDeduction="onDeductionUpdate"
          ></deduction-table>
          <collection-result-table
            @updatePaidList="onPaidListUpdate"
          ></collection-result-table>
          <reward-and-penalty-table
            v-if="hasSessionStorage && incumbents && monthlyFee"
            :closingdate="readDraft().closingDate"
            :incumbents="incumbents"
            :monthlyfee="monthlyFee"
            @updateRewardAndPenalty="onRewardAndPenaltyUpdate"
          ></reward-and-penalty-table>
          <v-btn
            color="error"
            block
            x-large
            depressed
            class="mx-1"
            @click="confirmClosing()"
          >
            <v-icon class="mr-1">mdi-security</v-icon
            >この内容で確定して寮費請求を実行
          </v-btn>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      monthlyFee: null,
      hasSessionStorage: false, // should be a computed value instead?
      persons: { beforeDeduction: null, afterDeduction: null }, // will be calculated by child component
      incumbents: null
    };
  },
  methods: {
    onMonthlyFeeUpdate(payload) {
      this.monthlyFee = payload.feeAmount;
      this.updateDraftDiff(payload);
    },
    onDeductionUpdate(payload) {
      this.persons.beforeDeduction = payload.personsTotal.beforeDeduction;
      this.persons.afterDeduction = payload.personsTotal.afterDeduction;
      this.incumbents = payload.incumbents;
      this.updateDraftDiff(payload);
    },
    onPaidListUpdate(paidList) {
      const paidBillIds = {
        paidBillIds: paidList.reduce((acc, cur) => {
          acc.push(cur.id);
          return acc;
        }, [])
      };
      this.updateDraftDiff(paidBillIds);
    },
    onRewardAndPenaltyUpdate(rewards) {
      this.updateDraftDiff({ rewards });
    },
    readDraft() {
      return JSON.parse(sessionStorage.getItem("draft"));
    },
    setDraft(newDraft) {
      sessionStorage.clear(); // To avoid unexpected side-effect
      sessionStorage.setItem("draft", JSON.stringify(newDraft));
      this.hasSessionStorage = true; // For certainty
    },
    createDraft(newClosingDate) {
      const newDraft = {
        closingDate: newClosingDate
      };
      this.setDraft(newDraft);
    },
    clearDraft() {
      sessionStorage.clear();
      this.hasSessionStorage = false;
    },
    /**
     * Get a new part of the draft as a object,
     * update the part in the draft.
     * The other parts will be kept as they are if not affected by the part.
     */
    updateDraftDiff(draftDiff) {
      let draftCopy = JSON.parse(JSON.stringify(this.readDraft()));
      Object.assign(draftCopy, draftDiff);
      this.setDraft(draftCopy);
    },
    confirmClosing(){
      // Register to billings table (add new items, update paid_at status)
      // Register to billing_details table
      // Register to monthly_fees table
      // Trigger reload of arrears component & monthly fees component

      this.clearDraft();
    },
    initParams() {
      // Init JS cache
      this.monthlyFee = null;
      this.persons = { beforeDeduction: null, afterDeduction: null };
      this.incumbents = null;

      // Init sessionStorage
      this.clearDraft();
    }
  },
  mounted() {
    // When the page is newly opened, or reloaded
    this.initParams();
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle !important;
}
</style>
