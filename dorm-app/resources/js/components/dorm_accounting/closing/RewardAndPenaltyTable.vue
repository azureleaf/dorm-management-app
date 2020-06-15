<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>賞罰処理</span>
      <v-spacer></v-spacer>
      <reward-and-penalty-dialog
        v-if="users.length != 0 && titles.length != 0"
        :users="users"
        :titles="titles"
        @setRewards="onRewardsSet"
      ></reward-and-penalty-dialog>
    </v-card-title>
    <v-card-subtitle
      >委員会報酬の割合についてはここでは編集できません。役職記録から変更してください。</v-card-subtitle
    >
    <v-card-text>
      <v-row>
        <v-col>
          <v-data-table
            :headers="targetUserHeaders"
            :items="targetUsers"
            :items-per-page="10"
          >
            <template v-slot:item.amount="{ item }">
              <span>{{ formatCurrency(item.amount) }}</span>
            </template>
            <template v-slot:item.delete="{ item }">
              <v-btn
                color="error"
                depressed
                dense
                @click="deleteRow(item.rowId)"
                :disabled="!item.isDeletable"
              >
                <v-icon>mdi-trash-can</v-icon>
              </v-btn>
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["closingdate", "incumbents", "monthlyfee"],
  data: function() {
    return {
      isAdmin: true,
      lastRowIndex: 0, // used to index every v-data-table row
      titles: [],
      targetUsers: [],
      users: [],
      targetUserHeaders: [
        {
          text: "項目ID",
          sortable: false,
          value: "rowId"
        },
        {
          text: "寮生ID",
          sortable: false,
          value: "userId"
        },
        {
          text: "氏名",
          sortable: false,
          value: "fullName"
        },
        {
          text: "賞罰科目",
          sortable: false,
          value: "title"
        },
        {
          text: "金額",
          sortable: false,
          value: "amount"
        },
        {
          text: "特記事項",
          sortable: false,
          value: "comment"
        },
        {
          text: "削除",
          sortable: false,
          value: "delete"
        }
      ]
    };
  },
  methods: {
    /**
     * Get values emitted from the dialog component,
     * format them, then push them to the v-data-table arrays
     *
     * @param {Obj} rewards Emitted value from the child dialog component
     */
    onRewardsSet(rewards) {
      rewards.targetUsers.forEach(targetUser => {
        this.targetUsers.push({
          rowId: ++this.lastRowIndex, // increment then assign. Must be UNIQUE
          userId: targetUser.id,
          fullName: targetUser.full_name,
          title: rewards.title.name_with_id, // e.g. "200: 基本金請求"
          titleId: rewards.title.id, // e.g. 200
          amount: rewards.amount,
          comment: rewards.comment,
          isDeletable: true
        });
      });

      this.emitCurrentTargets();
    },
    /**
     * Emit the entire rewards / penalty info to the parent component
     */
    emitCurrentTargets() {
      this.$emit("updateRewardAndPenalty", this.targetUsers);
    },
    /**
     * Delete the element with the specified ID in the array.
     * 
     * @param {Number} rowId Unique (but not always sequential) ID of the element in the targetUsers array
     */
    deleteRow(rowId) {
      const rowIndex = this.targetUsers.findIndex(user => {
        return user.rowId == rowId;
      });
      this.targetUsers.splice(rowIndex, 1);
      this.emitCurrentTargets();
    },
    /**
     * Set the rewards to the incumbent users who have committee roles,
     *  then urge the parent component to store it to the sessionStorage
     *
     * @param {Number} monthlyFee
     *  Amount of monthly fee calculated by the MonthlyFee.vue,
     *  and will be imposed to all the users
     */
    setRoleRewards(monthlyFee) {
      // All the existing rows of committee roles must be cleared,
      // while other penalties & rewards must be kept.
      
      // Create the list of row IDs to be deleted
      const oldCommitteeRewardRowIds = this.targetUsers.reduce((acc, row) => {
        if (row.isDeletable == false) {
          acc.push(row.rowId);
        }
        return acc;
      }, []);

      // Remove the rows of old committee rewards
      oldCommitteeRewardRowIds.forEach(id => {
        this.deleteRow(id);
      });

      // Calculate the new reward amount
      //   based on the monthly fee & reward ratio
      this.incumbents.forEach(incumbent => {
        this.targetUsers.push({
          // rowId must be UNIQUE, and the same value mustn't be reused
          rowId: ++this.lastRowIndex, // increment then assign
          userId: incumbent.user.id,
          fullName: incumbent.user.full_name,
          title: "100: 委員会報酬", // Hard-coded!
          titleId: 100, // Hard-coded!
          amount: -Math.ceil(incumbent.reward_pct * 0.01 * monthlyFee),
          comment: `${incumbent.role_title.name}（${incumbent.reward_pct}％免除）`,
          isDeletable: false
        });
      });

      this.emitCurrentTargets();
    },
    /**
     * Axios: Retrieve the list of personal account titles:
     *   e.g. 委員会報酬、 清掃報酬, 基本金請求, 清掃放棄罰金...
     */
    async retrieveAccountTitles() {
      const res = await axios.get("./personal/titles");
      this.titles = res.data;
    },
    /**
     * Axios: Retrieve the list of users who lived in the month
     */
    async retrieveUsers() {
      // Parse YYYY-MM-DD into Date object
      const d = new Date(this.closingdate);

      const res = await axios.get(
        `./users/monthly/${d.getFullYear()}/${d.getMonth()}`
      );
      this.users = res.data;
    }
  },
  watch: {
    /**
     * Detect the update of the props,
     * then update source array for v-data-table accordingly
     *
     * @param {Number} newFee
     * @param {Number} oldFee
     */
    monthlyfee(newFee, oldFee) {
      this.setRoleRewards(newFee);
    }
  },
  mounted() {
    this.retrieveUsers();
    this.retrieveAccountTitles();
    this.setRoleRewards(this.monthlyfee);
  }
};
</script>
<style scoped>
</style>
