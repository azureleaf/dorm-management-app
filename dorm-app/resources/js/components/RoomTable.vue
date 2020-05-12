<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>居室履歴</v-card-title>
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
          text: "ID",
          sortable: true,
          value: "id"
        },
        {
          text: "部屋番号",
          sortable: true,
          value: ""
        },
        {
          text: "居住者",
          sortable: true,
          value: "name"
        },

        {
          text: "更新事由",
          sortable: true,
          value: ""
        },
        {
          text: "更新日",
          sortable: true,
          value: ""
        },
        {
          text: "居室状態",
          sortable: true,
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
