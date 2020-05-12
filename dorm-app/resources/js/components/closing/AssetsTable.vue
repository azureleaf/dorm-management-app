<template>
  <v-card outlined>
    <v-card-title>資産内訳</v-card-title>
    <v-card-text>
      滞納者未払金, 他寮未払金
      <v-data-table :headers="assetHeaders" :items="assetItems" :items-per-page="20"></v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      assetItems: [
        {
          name: "現金",
          amount: 555555
        },
        {
          name: "七十七銀行預金",
          amount: 555555
        },
        {
          name: "ゆうちょ銀行預金",
          amount: 555555
        },
        {
          name: "寮費滞納者未払金",
          amount: 555555
        },
        {
          name: "三寮会計未徴収金",
          amount: 555555
        },
        {
          name: "三寮会計未払金",
          amount: -12355
        },
         {
          name: "切手",
          amount: 500
        }
      ],
      assetHeaders: [
        {
          text: "資産区分ID",
          sortable: true,
          value: "id"
        },
        {
          text: "資産種別",
          sortable: true,
          value: "name"
        },
        {
          text: "金額",
          sortable: true,
          value: "amount"
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
