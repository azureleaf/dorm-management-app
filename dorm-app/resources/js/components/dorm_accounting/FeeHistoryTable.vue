<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>基本金推移</v-card-title>
        <v-card-text>
          ここにChart.jsの表がくる
          <v-data-table
            :headers="feesHeaders"
            :items="fees"
            :items-per-page="10"
          >
            <template v-slot:item.total_amount="{ item }">
              {{ formatCurrency(item.total_amount) }}
            </template>

            <template v-slot:item.fee_amount="{ item }">
              {{ formatCurrency(item.fee_amount) }}
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
      fees: [],
      feesHeaders: [
        {
          text: "ID",
          sortable: true,
          value: "id"
        },
        {
          text: "決算期",
          sortable: true,
          value: "closing_name"
        },
        {
          text: "決算日",
          sortable: false,
          value: "closed_at"
        },
        {
          text: "徴収総額",
          sortable: true,
          value: "total_amount"
        },
        {
          text: "実人数",
          sortable: true,
          value: "persons_before_deduction"
        },
        {
          text: "換算負担人数",
          sortable: true,
          value: "persons_after_deduction"
        },
        {
          text: "基本金",
          sortable: true,
          value: "fee_amount"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./monthly-fees");
    this.fees = res.data;
  }
};
</script>
<style scoped>
</style>
