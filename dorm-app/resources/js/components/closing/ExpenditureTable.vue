<template>
  <v-card outlined class="mb-4">
    <v-card-title>支出の部</v-card-title>
    <v-card-text>
      <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      periods: ["2020-05", "2020-06", "2020-07"],
      billItems: [],
      billingHeaders: [
        {
          text: "寮会計処理ID",
          sortable: true,
          value: "id"
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
          text: "支出額",
          sortable: true,
          value: "payment"
        },
        {
          text: "特記事項",
          sortable: true,
          value: "comment"
        },
      ]
    };
  },
  computed: {
    periodSelected() {
      return this.periods[this.periods.length - 1];
    }
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
</style>
