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
      >委員会報酬についてはここでは編集できませんので、役職記録から変更してください。</v-card-subtitle
    >
    <v-card-text>
      <v-row>
        <v-col>
          <v-data-table
            :headers="targetUserHeaders"
            :items="targetUsers"
            :items-per-page="targetUsers.length"
          >
            <template v-slot:item.amount="{ item }">
              <span>{{ formatCurrency(item.amount) }}</span>
            </template>
            <template v-slot:item.delete="{ item }">
              <v-btn
                color="error"
                depressed
                dark
                dense
                @click="deleteItem(item.rowId)"
              >
                <v-icon class="mr-1">mdi-trash-can</v-icon>
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
  props: ["closingdate"],
  data: function() {
    return {
      isAdmin: true,
      lastRowIndex: 0, // used to index every v-data-table row
      titles: [],
      targetUsers: [],
      users: [],
      targetUserHeaders: [
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
    onRewardsSet(rewards) {
      // Get emitted values, format them,
      // then push them to the v-data-table arrays
      rewards.targetUsers.forEach(targetUser => {
        this.targetUsers.push({
          rowId: ++this.lastRowIndex, // increment then assign. Must be UNIQUE 
          userId: targetUser.id,
          fullName: targetUser.full_name,
          title: rewards.title.name_with_id,
          amount: rewards.amount,
          comment: rewards.comment
        });
      });

      this.emitCurrentTargets();
    },
    emitCurrentTargets() {
      // Emit the entire rewards / penalty info to the parent component
      this.$emit("updateRewardAndPenalty", this.targetUsers);
    },
    deleteItem(rowId) {
      // Delete the element with the specified ID in the array
      // Row index is always sequential,
      // while row IDs may come at intervals
      const rowIndex = this.targetUsers.findIndex(user => {
        return user.rowId == rowId;
      });
      this.targetUsers.splice(rowIndex, 1);
      this.emitCurrentTargets();
    },
    async retrieveAccountTitles() {
      const res = await axios.get("./personal/titles");
      this.titles = res.data;
    },
    async retrieveUsers() {
      // Parse YYYY-MM-DD into Date object
      const d = new Date(this.closingdate);

      const res = await axios.get(
        `./users/monthly/${d.getFullYear()}/${d.getMonth()}`
      );
      this.users = res.data;
    }
  },
  mounted: async function() {
    this.retrieveUsers();
    this.retrieveAccountTitles();
  }
};
</script>
<style scoped>
</style>
