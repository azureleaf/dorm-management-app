<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮費請求原稿</span>
          <v-chip
            label
            outlined
            color="green darken-2"
            class="ml-4 font-weight-bold"
            dark
          >
            決算日：{{ closingDate }}
          </v-chip>
          <v-spacer></v-spacer>
          <v-btn v-if="hasSessionStorage" color="error" depressed class="mx-1">
            <v-icon class="mr-1">mdi-close-circle</v-icon>作成中の請求原稿を破棄
          </v-btn>
          <v-btn v-else color="error" depressed class="mx-1">
            <v-icon class="mr-1">mdi-plus-circle</v-icon>請求原稿の新規作成
          </v-btn>
        </v-card-title>
        <v-card-text>
          <monthly-fee
            v-if="feeComp && persons.beforeDeduction"
            :personsprop="persons"
            :feedb="feeComp"
          ></monthly-fee>
          <deduction-table
            v-if="feeComp"
            :closingdate="feeComp.closed_at"
            @updateDeduction="onDeductionUpdate"
          ></deduction-table>
          <collection-result-table></collection-result-table>
          <reward-and-penalty-table
            :year="year"
            :month="month"
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
      hasSessionStorage: true,
      persons: { beforeDeduction: null, afterDeduction: null }, // will be calculated by child component
      fees: [],
      year: 2020,
      month: 5
    };
  },
  computed: {
    // To suppress error of "Cannot read property xxx of undefined",
    // program doesn't try to read deep layer values when the fees[] obj isn't loaded yet
    feeComp() {
      return this.fees.length == 0 ? "" : this.fees[0];
    },
    closingDate() {
      return this.feeComp.closed_at ? this.feeComp.closed_at : "決算日未定";
    },
    approvalDate() {
      return this.feeComp.approved_at
        ? this.feeComp.approved_at
        : "寮生大会未承認";
    }
  },
  methods: {
    // Load from DB, set fees[]
    // ASSUMPTION: axios result is ordered by the date of closing; the latest is the first
    async loadFees() {
      const res = await axios.get("./monthly-fees");
      this.fees = res.data;
    },
    onDeductionUpdate(totals) {
      this.persons.beforeDeduction = totals.beforeDeduction;
      this.persons.afterDeduction = totals.afterDeduction;
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
