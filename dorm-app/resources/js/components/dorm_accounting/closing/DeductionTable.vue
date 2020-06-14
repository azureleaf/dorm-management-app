<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>負担人数</span>
    </v-card-title>
    <v-card-subtitle>
      決算日の前月に１日でも在寮した人は、負担者数に計上されます。<br />決算日の時点で委員会の役職が設定されている寮生は寮費が減免されます。
    </v-card-subtitle>
    <v-card-text>
      <v-data-table
        :headers="burdenHeaders"
        :items="burdens"
        :items-per-page="burdens.length"
        hide-default-footer
      >
        <template v-slot:item.persons_before_deduction="{ item }">
          <span :class="{ emphasis: item.isTotalRow }">{{
            item.persons_before_deduction
          }}</span>
        </template>
        <template v-slot:item.persons_after_deduction="{ item }">
          <span :class="{ emphasis: item.isTotalRow }">{{
            item.persons_after_deduction
          }}</span>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["closingdate"], // YYYY-MM-DD
  data: function() {
    return {
      incumbents: null,
      burdens: [],
      // sum of the persons in the table
      personsTotals: {
        beforeDeduction: null,
        afterDeduction: null
      },
      burdenHeaders: [
        {
          text: "職名",
          sortable: false,
          value: "role_name"
        },
        {
          text: "負担率",
          sortable: false,
          value: "burden_rate"
        },
        {
          text: "実人数",
          sortable: false,
          value: "persons_before_deduction"
        },
        {
          text: "換算負担人数",
          sortable: false,
          value: "persons_after_deduction"
        }
      ]
    };
  },
  computed: {
    periodSelected() {
      return this.periods[this.periods.length - 1];
    }
  },
  methods: {
    async loadIncumbents() {
      const res = await axios.post("/role-histories/incumbents", {
        date: this.closingdate
      });
      return res.data;
    },
    async loadRoleTitles() {
      const res = await axios.get("/role-titles/");
      return res.data;
    },
    async countUsersBackThen() {
      // Convert YYYY-MM-DD string to Date obj
      const dateFmt = new Date(this.closingdate);

      // Number of users in the previous month of the closing date matters
      // .setMonth() destructively alters the original Date obj
      dateFmt.setMonth(dateFmt.getMonth() - 1);

      // Note that January in Date() obj is "0"
      const res = await axios.get(
        `/users/monthly/${dateFmt.getFullYear()}/${dateFmt.getMonth() + 1}`
      );

      return res.data.length;
    },
    /**
     * Set burdens[] array which is shown in v-data-table
     */
    async setBurdens() {
      this.incumbents = await this.loadIncumbents();
      const roleTitles = await this.loadRoleTitles();
      this.personsTotals.beforeDeduction = await this.countUsersBackThen();

      // Append committee members to the table
      roleTitles.forEach(roleTitle => {
        // Number of persons per reward of this role title
        // e.g. {75: 2, 100: 1} means that;
        // 3 persons have this role, and out of them
        // 2 get 75% reward, 1 gets 100% reward"
        let personsByRewards = {};

        // Search for the committee member with this role title
        this.incumbents.forEach(incumbent => {
          // If the member has the role of the interest
          if (roleTitle.id == incumbent.role_title_id) {
            if (incumbent.reward_pct in personsByRewards) {
              personsByRewards[incumbent.reward_pct]++;
            } else {
              personsByRewards[incumbent.reward_pct] = 1;
            }
          }
        });

        // Append the result to the array for v-data-table
        for (const [reward_pct, persons] of Object.entries(personsByRewards)) {
          const burden_rate = 1 - reward_pct / 100;

          // Change role title when the reward is changed from the default
          const roleTitleDisplayed =
            reward_pct == roleTitle.default_reward_pct
              ? roleTitle.name
              : roleTitle.name + "（特別負担率適用）";

          this.burdens.push({
            role_name: roleTitleDisplayed,
            burden_rate: burden_rate,
            persons_before_deduction: persons,
            persons_after_deduction: persons * burden_rate
          });
        }
      });

      // Append normal boarders to the table
      const normalUsersCount =
        this.personsTotals.beforeDeduction - this.incumbents.length;
      this.burdens.push({
        role_name: "一般寮生",
        burden_rate: 1,
        persons_before_deduction: normalUsersCount,
        persons_after_deduction: normalUsersCount * 1
      });

      // Append total to the table
      this.personsTotals.afterDeduction = this.burdens
        .reduce((acc, curr) => {
          return acc + curr.persons_after_deduction;
        }, 0)
        .toFixed(2);

      this.burdens.push({
        role_name: "合計",
        burden_rate: "",
        persons_before_deduction: this.personsTotals.beforeDeduction,
        persons_after_deduction: this.personsTotals.afterDeduction,
        isTotalRow: true
      });
    }
  },
  async mounted() {
    await this.setBurdens();

    // Tell the parent component the number of persons who'll pay for the monthly fee
    this.$emit("updateDeduction", {
      personsTotal: this.personsTotals,
      incumbents: this.incumbents
    });
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}

.emphasis {
  font-weight: bold;
  color: crimson;
}
</style>
