<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮費請求</span>
          <v-spacer></v-spacer>
          <closing-tables-dialog
            v-if="!hasSessionStorage"
            @setClosingDate="onDraftCreation"
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
                  決算日：{{ readDraft().closingDate }} （{{
                    readDraft().year
                  }}年{{ readDraft().month }}月分決算）
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
    onDraftCreation(payload) {
      this.setDraft(payload);
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
    isDraftFilledOut(draft) {
      /**
       * Check if all the required items are set in the sessionStorage
       */
      const requiredKeys = [
        { value: "closingDate", text: "決算日" },
        { value: "totalAmount", text: "徴収総額" },
        { value: "feeAmount", text: "基本金" },
        { value: "personsTotal", text: "負担人数・換算負担人数" },
        { value: "paidBillIds", text: "寮費徴収結果" },
        { value: "rewards", text: "賞罰処理" }
      ];
      return requiredKeys.every(key => {
        if (!(key.value in draft)) {
          alert(`${key.text}が入力されていません。`);
          return false; // this breaks the "every" loop
        } else {
          return true;
        }
      });
    },
    async storeMonthlyFee(draft) {
      try {
        const res = await axios.post("/monthly-fees", {
          year: draft.year,
          month: draft.month,
          closed_at: draft.closingDate,
          persons: draft.personsTotal.beforeDeduction,
          persons_after_deduction: draft.personsTotal.afterDeduction,
          total_amount: draft.totalAmount,
          fee_amount: draft.feeAmount
        });
      } catch (e) {
        console.error(e);
        return;
      }

      console.debug("Successfully stored new monthly fee.");
    },
    async storePaidBillings(draft) {
      try {
        const res = await axios.put("/billings/update/paid", {
          billingIds: draft.paidBillIds,
          closingDate: draft.closingDate
        });
      } catch (e) {
        console.error(e);
        return;
      }

      console.debug("Successfully stored paid billings.");
    },
    async storeNewBillings(draft) {
      try {
        // const res = await axios.put("/billings/update/paid", {});
      } catch (e) {
        console.error(e);
        return;
      }
      console.debug("Successfully stored new billings.");
    },
    async confirmClosing() {
      // Confirm the draft and finalize the billing process on button click

      const draft = this.readDraft();

      // Abort submission when required fields aren't fully set
      if (!this.isDraftFilledOut(draft)) return;

      // Update paid billings
      await this.storePaidBillings(draft);

      // Register to billings &billing_details table (add new items)
      await this.storeNewBillings(draft);

      // Register to monthly_fees table
      await this.storeMonthlyFee(draft);

      // Clear sessionStorage
      this.clearDraft();

      // Trigger page reload
      // in order to update arrears component & monthly fees component
      location.reload();
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
