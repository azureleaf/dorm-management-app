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
      >委員会報酬についてはここでは編集できません。</v-card-subtitle
    >
    <v-card-text>
      <v-row>
        <v-col>
          <v-data-table
            :headers="userHeaders"
            :items="users"
            :items-per-page="users.length"
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
      users: [],
      userHeaders: [
        {
          text: "寮生ID",
          sortable: false,
          value: "id"
        },
        {
          text: "氏名",
          sortable: false,
          value: "full_name"
        },
        {
          text: "賞罰詳細金額",
          sortable: false,
          value: "items"
        },
        {
          text: "賞罰合計額",
          sortable: false,
          value: "balance"
        },
        {
          text: "新規追加",
          sortable: false,
          value: "create"
        }
      ]
    };
  },
  methods: {
    onRewardsSet(rewards) {
      console.log("rewards emitted:", rewards);
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
