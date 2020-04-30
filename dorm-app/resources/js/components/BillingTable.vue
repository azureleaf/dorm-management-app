<template>
  <v-content>
    <v-container>
      <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      billItems: [],
      billingHeaders: [
        {
          text: "会計処理ID",
          sortable: true,
          value: "id"
        },
        {
          text: "対象寮生ID",
          sortable: true,
          value: "userId"
        },
        {
          text: "摘要",
          sortable: true,
          value: "abstract"
        },
        {
          text: "請求額",
          sortable: true,
          value: "billing"
        },
        {
          text: "支払額",
          sortable: true,
          value: "payment"
        },

        {
          text: "支払残高",
          sortable: true,
          value: "balance"
        },

        {
          text: "処理登録日",
          sortable: true,
          value: "created_at"
        },
        {
          text: "処理更新額",
          sortable: true,
          value: "updated_at"
        }
      ]
    };
  },
  mounted: async function() {
    console.log("Component mounted.");
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./billings");
    this.billItems = res.data;
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
