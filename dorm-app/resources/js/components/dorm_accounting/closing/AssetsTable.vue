<template>
  <v-card outlined class="mb-4">
    <v-card-title>資産内訳</v-card-title>
    <v-card-text>
      <v-row class="pb-5">
        <v-col>
          <v-btn color="error" depressed absolute right>
            <v-icon class="mr-1">mdi-security</v-icon>資産変動の登録
          </v-btn>
        </v-col>
      </v-row>
      <v-data-table :headers="assetHeaders" :items="assetItems" :items-per-page="20" :hide-default-footer="true"></v-data-table>
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
          name: "寮費滞納者未収金",
          amount: 555555
        },
        {
          name: "三寮会計未収金",
          amount: 555555
        },
        {
          name: "切手",
          amount: 500
        },
        {
          name: "合計額（C）",
          amount: 500
        }
      ],
      assetHeaders: [
        {
          text: "資産種別",
          sortable: false,
          value: "name"
        },
        {
          text: "期首残高",
          sortable: false,
          value: "amount"
        },
        {
          text: "期末残高",
          sortable: false,
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
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
