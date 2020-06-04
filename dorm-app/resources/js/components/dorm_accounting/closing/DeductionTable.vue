<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>負担人数</span>
    </v-card-title>
    <v-card-text>
      <!-- <v-card class="pa-3 formula" flat outlined>
        <v-chip outlined label large color="green darken-2">一般会計支出： 200000</v-chip>
        <span class="display-1">÷</span>
        <v-chip outlined label large color="green darken-2">負担人数： 45.2</v-chip>
        <span class="display-1">=</span>
        <v-chip outlined label large color="red">寮費（端数切り上げ）： 12345</v-chip>
      </v-card>-->
      <v-data-table
        :headers="burdenHeaders"
        :items="burdens"
        :items-per-page="burdens.length"
        hide-default-footer
      >
        <template v-slot:item.persons="{ item }">
          <span :class="{ emphasis: item.isTotalRow }">{{ item.persons }}</span>
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
  data: function() {
    return {
      burdens: [],
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
          value: "persons"
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
      const res = await axios.get("/role-histories/incumbent");
      return res.data;
    },
    async loadRoleTitles() {
      const res = await axios.get("/role-titles/");
      return res.data;
    },
    async countCurrentUsers() {
      const res = await axios.get("/users");
      const count = res.data.reduce((acc, curr) => {
        if (curr.move_out_at == null) return ++acc;
        else return acc;
      }, 0);
      return count;
    },
    /**
     * Set burdens[] array which is shown in v-data-table
     */
    async setBurdens() {
      const incumbents = await this.loadIncumbents();
      const roleTitles = await this.loadRoleTitles();
      const currentUsersCount = await this.countCurrentUsers();

      // Append committee members to the table
      roleTitles.forEach(roleTitle => {
        // Number of persons per reward of this role title
        // e.g. {75: 2, 100: 1} means that;
        // 3 persons have this role, and out of them
        // 2 get 75% reward, 1 gets 100% reward"
        let personsByRewards = {};

        // Search for the committee member with this role title
        incumbents.forEach(incumbent => {
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
            persons: persons,
            persons_after_deduction: persons * burden_rate
          });
        }
      });

      // Append normal boarders to the table
      const normalUsersCount = currentUsersCount - incumbents.length;
      this.burdens.push({
        role_name: "一般寮生",
        burden_rate: 1,
        persons: normalUsersCount,
        persons_after_deduction: normalUsersCount * 1
      });

      // Append total to the table
      const personsAfterDeductionTotal = this.burdens.reduce((acc, curr) => {
        return acc + curr.persons_after_deduction;
      }, 0);
      this.burdens.push({
        role_name: "合計",
        burden_rate: "",
        persons: currentUsersCount,
        persons_after_deduction: personsAfterDeductionTotal,
        isTotalRow: true
      });
    }
  },
  mounted: async function() {
    await this.setBurdens();

    // Tell the parent component the number of persons who'll pay for the monthly fee
    // Suppose that the last row is the total of each column
    this.$emit(
      "updateDeduction",
      this.burdens[this.burdens.length - 1].persons_after_deduction
    );
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
