<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮費科目</v-card-title>
        <v-card-subtitle>報酬や罰金など寮費の種類の一覧です。</v-card-subtitle>
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
          text: "寮費科目ID",
          sortable: true,
          value: ""
        },
        {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "金額の既定値",
          sortable: true,
          value: ""
        },
         {
          text: "説明",
          sortable: true,
          value: ""
        },
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
