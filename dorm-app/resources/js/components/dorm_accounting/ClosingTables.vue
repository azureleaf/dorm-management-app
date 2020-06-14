<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮費請求</span>
          <v-spacer></v-spacer>
          <!-- Conditionally display creation buttons -->
          <closing-tables-dialog
            v-if="!hasSessionStorage"
            @setClosingDate="onDraftCreation"
          ></closing-tables-dialog>
          <!-- Conditionally display deletion buttons -->
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
          <!-- Tables -->
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
          <!-- Settlement button -->
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
      // should be a computed value instead?
      hasSessionStorage: false,

      /**
       *  Vars for props-down & $emit
       */
      monthlyFee: null, // calculated by child component
      persons: { beforeDeduction: null, afterDeduction: null }, // calculated by child component
      incumbents: null
    };
  },
  methods: {
    /**
     * $emit Event handlers: MonthlyFee.vue
     * @param {Object} payload
     */
    onMonthlyFeeUpdate(payload) {
      this.monthlyFee = payload.feeAmount;
      this.updateDraftDiff(payload);
    },
    /**
     * $emit Event handlers: DeductionTable.vue
     * @param {Object} payload
     *
     */
    onDeductionUpdate(payload) {
      this.persons.beforeDeduction = payload.personsTotal.beforeDeduction;
      this.persons.afterDeduction = payload.personsTotal.afterDeduction;
      this.incumbents = payload.incumbents;
      this.updateDraftDiff(payload);
    },
    /**
     * $emit Event handlers: CollectionResultTable.vue
     *
     * @param {Array} paidList
     */
    onPaidListUpdate(paidList) {
      const paidBillIds = {
        paidBillIds: paidList.reduce((acc, cur) => {
          acc.push(cur.id);
          return acc;
        }, [])
      };
      this.updateDraftDiff(paidBillIds);
    },
    /**
     * $emit Event handlers: RewardAndPenaltyTable.vue
     *
     * @param {Object} rewards
     */
    onRewardAndPenaltyUpdate(rewards) {
      this.updateDraftDiff({ rewards });
    },
    /**
     * sessionStorage: Read
     */
    readDraft() {
      return JSON.parse(sessionStorage.getItem("draft"));
    },
    /**
     * sessionStorage: Update (Replacement)
     */
    setDraft(newDraft) {
      sessionStorage.clear(); // To avoid unexpected side-effect
      sessionStorage.setItem("draft", JSON.stringify(newDraft));
      this.hasSessionStorage = true; // For certainty
    },
    /**
     * sessionStorage: Create
     * @param {Object} payload
     */
    onDraftCreation(payload) {
      this.setDraft(payload);
    },
    /**
     * sessionStorage: Delete
     */
    clearDraft() {
      sessionStorage.clear();
      this.hasSessionStorage = false;
    },
    /**
     * sessionStorage: Update (Partial replacement / Append)
     * Get a new part of the draft as a object, and update with it.
     * The other parts will be kept as they are.
     *
     * @param {Object} draftDiff item(s) of sessionStorage
     */
    updateDraftDiff(draftDiff) {
      let draftCopy = JSON.parse(JSON.stringify(this.readDraft()));
      Object.assign(draftCopy, draftDiff);
      this.setDraft(draftCopy);
    },
    /**
     * SessionStorage: Validate
     * Check if all the required items are set in the sessionStorage
     *
     * @param {Object} draft sessionStorage contents
     * @returns {Boolean}
     */
    isDraftFilledOut(draft) {
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
    /**
     * Axios: Insert the calcuated new monthly fee
     *
     * @param {Object} draft sessionStorage contents
     * @returns {Number|undefined}
     */
    async storeMonthlyFee(draft) {
      try {
        const res = await axios.post("/monthly-fees", {
          year: draft.year,
          month: draft.month,
          closed_at: draft.closingDate,
          persons_before_deduction: draft.personsTotal.beforeDeduction,
          persons_after_deduction: draft.personsTotal.afterDeduction,
          total_amount: draft.totalAmount,
          fee_amount: draft.feeAmount
        });
      } catch (e) {
        console.error(e);
        return 1;
      }

      console.debug("Successfully stored new monthly fee.");
    },
    /**
     * Axios: Update paid / unpaid status of the former billings
     *
     * @param {Object} draft sessionStorage contents
     * @returns {Number|undefined}
     *
     */
    async storePaidBillings(draft) {
      try {
        const res = await axios.put("/billings/update/paid", {
          billingIds: draft.paidBillIds,
          closingDate: draft.closingDate
        });
      } catch (e) {
        console.error(e);
        return 1;
      }

      console.debug("Successfully stored paid billings.");
    },
    /**
     * Axios: Insert items to both billing & billing details table
     *
     * @param {Object} draft sessionStorage contents
     * @returns {Number|undefined}
     *
     */
    async storeNewBillings(draft) {
      // Retrieve all the users who lived in the month of interest
      const res = await axios.get(
        `./users/monthly/${this.readDraft().year}/${this.readDraft().month}`
      );
      const users = res.data;

      console.log("users", users);
      return;

      const billingDetsByUsers = users.reduce((acc, user) => {
        acc.push({
          userId: user.id,
          billingDets: [] // NOT COMPLETED HERE
        });
        return acc;
      }, []);

      let axiosPayload = {
        closed_at: readDraft().closingDate,
        year: readDraft().year,
        month: readDraft().month,
        users: billingDetsByUsers
      };

      try {
        const res = await axios.post("/billing-details/", axiosPayload);
      } catch (e) {
        console.error(e);
        return 1;
      }
      console.debug("Successfully stored new billings.");
    },
    /**
     * Axios: Settle the draft and finalize the billing process
     *
     * @param {Object} draft sessionStorage contents
     * @returns {Number|undefined}
     */
    async confirmClosing() {
      const draft = this.readDraft();

      // Abort submission when required fields aren't fully set
      if (!this.isDraftFilledOut(draft)) return;

      // Update paid / unpaid status of the former billings
      await this.storePaidBillings(draft);

      // Insert to billings & billing_details table
      await this.storeNewBillings(draft);

      // Insert to monthly_fees table
      await this.storeMonthlyFee(draft);

      // Clear sessionStorage
      this.clearDraft();

      // Trigger page reload
      // in order to update arrears component & monthly fees component
      // location.reload();
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
    // When the page is opened, or reloaded
    this.initParams();
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle !important;
}
</style>
