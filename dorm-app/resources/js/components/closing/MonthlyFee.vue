<template>
  <v-card outlined>
    <v-card-title>基本金</v-card-title>
    <v-card-subtitle>翌月の各寮生からの徴収予定額です。</v-card-subtitle>
    <v-card-text>
      <p>12,345</p>
      <p>委員会免除分</p>
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
          text: "発生日",
          sortable: true,
          value: "accrued_at"
        },
        {
          text: "収入種別",
          sortable: true,
          value: "category"
        },
        {
          text: "会計区分",
          sortable: true,
          value: ""
        },
        {
          text: "摘要",
          sortable: true,
          value: "abstract"
        },
        {
          text: "収入額",
          sortable: true,
          value: "billing"
        }
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
