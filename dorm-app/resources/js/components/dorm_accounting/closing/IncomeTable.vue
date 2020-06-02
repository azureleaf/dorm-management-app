<template>
  <v-card outlined class="my-5">
    <v-card-title>収入の部</v-card-title>
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
          text: "発生日",
          sortable: true,
          value: "accrued_at"
        },
        {
          text: "収入科目",
          sortable: true,
          value: "category"
        },
        {
          text: "会計",
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
        },
        {
          text: "特記事項",
          sortable: true,
          value: "comment"
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
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
