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
          ></v-data-table>
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
      console.log("rewards emitted:", rewards);

      rewards.targetUsers.forEach(targetUser => {
        this.targetUsers.push({
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
      this.$emit("updateRewardAndPenalty", this.targetUsers);
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
