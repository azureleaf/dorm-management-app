<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>賞罰履歴</v-card-title>
        <v-card-subtitle>直近三ヶ月に寮生に課せられた報酬と罰金の一覧です。</v-card-subtitle>
        <v-card-text>
          <v-data-table :headers="userHeaders" :items="users" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      users: [],
      userHeaders: [
        {
          text: "部屋番号",
          sortable: true,
          value: ""
        },
        {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "罰金区分",
          sortable: true,
          value: ""
        },
         {
          text: "特記事項",
          sortable: true,
          value: ""
        },
        {
          text: "罰金額",
          sortable: true,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped></style>
