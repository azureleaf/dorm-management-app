<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>滞納者番付</v-card-title>
        <v-card-subtitle
          >寮費滞納は最も重大な寮規約違反です。悪質な滞納者には罰金を課し、大学への通知、実家からの債権回収、強制退寮処分を行います。</v-card-subtitle
        >
        <v-card-text>
          <v-data-table
            :headers="nonPayerHeaders"
            :items="nonPayers"
            :items-per-page="20"
          >
            <template v-slot:item.sum="{ item }">
              {{ formatCurrency(item.sum) }}
            </template>
            <template v-slot:item.months="{ item }">
              {{ item.months }}ヶ月
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
      nonPayers: [],
      nonPayerHeaders: [
        {
          text: "寮生ID",
          sortable: false,
          value: "user_id"
        },
        {
          text: "名前",
          sortable: false,
          value: "user.full_name"
        },
        {
          text: "滞納額",
          sortable: false,
          value: "sum"
        },
        {
          text: "滞納期間",
          sortable: false,
          value: "months"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billings/unpaid/ranking");
    this.nonPayers = res.data;
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
