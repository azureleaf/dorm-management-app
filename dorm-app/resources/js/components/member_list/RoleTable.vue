<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>役職履歴</v-card-title>
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
      users: "",
      userHeaders: [
        {
          text: "役職履歴ID",
          sortable: true,
          value: "id"
        },
        {
          text: "職名",
          sortable: true,
          value: ""
        },
        {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "開始日",
          sortable: true,
          value: ""
        },
        {
          text: "終了日",
          sortable: true,
          value: ""
        },
         {
          text: "特記事項",
          sortable: false,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    console.log("Component mountead.");
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped>
table {
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
}
</style>
