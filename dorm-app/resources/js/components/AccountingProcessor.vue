<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title>個人会計履歴</v-card-title>
        <v-card-text>
          <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
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
          text: "個人会計処理ID",
          sortable: true,
          value: "id"
        },
        {
          text: "対象寮生ID",
          sortable: true,
          value: "user_id"
        },
        {
          text: "処理登録日",
          sortable: true,
          value: "created_at"
        },
        {
          text: "区分",
          sortable: true,
          value: "category"
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
