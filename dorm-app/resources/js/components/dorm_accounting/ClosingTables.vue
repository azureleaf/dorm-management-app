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
            @click="clearDraft"
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
                  label
                  outlined
                  color="green darken-2"
                  class="px-4 ml-4 font-weight-bold"
                  large
                  dark
                >
                  決算日：{{ draft.closingDate }}
                </v-chip>
              </v-card-text>
            </v-card>
          </v-row>
          <monthly-fee
            v-if="persons.beforeDeduction"
            :personsprop="persons"
            @updateSS="updateDraftDiff"
          ></monthly-fee>
          <deduction-table
            :closingdate="draft.closingDate"
            @updateDeduction="onDeductionUpdate"
          ></deduction-table>
          <collection-result-table></collection-result-table>
          <reward-and-penalty-table
            :closingdate="draft.closingDate"
          ></reward-and-penalty-table>
          <v-btn color="error" block x-large depressed class="mx-1">
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
      hasSessionStorage: false, // should be a computed value instead?
      persons: { beforeDeduction: null, afterDeduction: null } // will be calculated by child component
    };
  },
  computed: {
    // This computed draft behaves as a proxy of the sessionStorage item
    draft: {
      get() {
        return JSON.parse(sessionStorage.getItem("draft"));
      },
      set(newDraft) {
        sessionStorage.clear(); // To avoid unexpected collision
        sessionStorage.setItem("draft", JSON.stringify(newDraft));
        this.hasSessionStorage = true; // For certainty
      }
    }
  },
  methods: {
    // Handle the emitted values from the deduction component
    onDeductionUpdate(totalPersons) {
      this.persons.beforeDeduction = totalPersons.beforeDeduction;
      this.persons.afterDeduction = totalPersons.afterDeduction;
    },
    createDraft(closingDate) {
      const newDraft = {
        closingDate: closingDate
      };
      this.draft = newDraft;
      console.log("new draft created:", this.draft);
    },
    clearDraft() {
      sessionStorage.clear();
      this.hasSessionStorage = false;
    },
    /**
     * Get a new part of the draft, update the part in the draft.
     * The other parts will be kept as they are if not affected by the part.
     */
    updateDraftDiff(draftDiff) {
      let draftCopy = JSON.parse(JSON.stringify(this.draft));

      for (let [key, value] of Object.entries(draftDiff)) {
        // "this.draft[key] = value;" will NOT trigger computed set()
        draftCopy[key] = value;
      }

      // This does trigger the set()
      this.draft = draftCopy;
    }
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle !important;
}
</style>
