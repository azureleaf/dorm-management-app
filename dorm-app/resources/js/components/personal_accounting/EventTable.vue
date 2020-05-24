<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>行事記録</v-card-title>
        <v-card-subtitle>当番や寮生大会出席の履歴です。</v-card-subtitle>
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
          text: "日付",
          sortable: true,
          value: ""
        },
        {
          text: "行事名",
          sortable: true,
          value: ""
        },
        {
          text: "実施結果（欠席届受理、罰金、成功）",
          sortable: true,
          value: "result"
        },
        {
          text: "特記事項",
          sortable: true,
          value: ""
        },
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped></style>
