<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>滞納者番付</v-card-title>
        <v-card-subtitle
          >寮費滞納は最も重大な規定違反です。速やかに返済してください。</v-card-subtitle
        >
        <v-card-text>
          <v-data-table
            :headers="nonPayerHeaders"
            :items="nonPayers"
            :items-per-page="20"
          ></v-data-table>
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
          text: "番付",
          sortable: true,
          value: ""
        },
        {
          text: "寮生ID",
          sortable: true,
          value: "user_id"
        },
        {
          text: "名前",
          sortable: true,
          value: "user.full_name"
        },
        {
          text: "滞納額",
          sortable: true,
          value: "sum"
        },
        {
          text: "滞納期間",
          sortable: true,
          value: ""
        },
        {
          text: "特記事項",
          sortable: true,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./billings/unpaid");
    this.nonPayers = res.data;
    console.log(res.data);
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
