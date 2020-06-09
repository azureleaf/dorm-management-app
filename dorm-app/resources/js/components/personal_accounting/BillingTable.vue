<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>請求記録</v-card-title>
        <v-card-subtitle>寮生個人への月々の請求額の内訳です。</v-card-subtitle>
        <v-card-text>
          <v-data-table
            :headers="billingHeaders"
            :items="billItems"
            :items-per-page="20"
          >
            <template v-slot:item.amount="{ item }">
              <span>{{ formatCurrency(item.amount) }}</span>
            </template>
          </v-data-table>
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
        // {
        //   text: "個人会計処理ID",
        //   sortable: true,
        //   value: "id"
        // },
        {
          text: "対象寮生ID",
          sortable: true,
          value: "billing.user_id"
        },
        {
          text: "対象寮生",
          sortable: true,
          value: "billing.user.full_name"
        },
        // {
        //   text: "処理登録日",
        //   sortable: true,
        //   value: "created_at"
        // },
        {
          text: "発生日",
          sortable: true,
          value: "billing.closed_at"
        },
        {
          text: "摘要",
          sortable: true,
          value: "abstract"
        },
        {
          text: "請求額",
          sortable: true,
          value: "amount"
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./billing-details");
    this.billItems = res.data;
    console.log(this.billItems);
  }
};
</script>
<style scoped>
</style>
