<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮費科目</v-card-title>
        <v-card-subtitle>報酬や罰金など寮費の種類の一覧です。</v-card-subtitle>
        <v-card-text>
          <v-data-table :headers="titleHeaders" :items="titles" :items-per-page="10">
            <template v-slot:item.is_payment="{item}">
              <v-icon v-if="item.is_payment" color="red">mdi-plus-circle-outline</v-icon>
              <v-icon v-else color="green">mdi-minus-circle-outline</v-icon>
              {{ item.is_payment ? "加算" : "減算"}}
            </template>
            <template v-slot:item.default_amount="{item}">
              <span v-if="item.default_amount != null">{{ formatCurrency(item.default_amount) }}</span>
              <span v-else>-</span>
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
      titles: [],
      titleHeaders: [
        {
          text: "寮費科目ID",
          sortable: false,
          value: "id"
        },
        {
          text: "名前",
          sortable: false,
          value: "name"
        },
        {
          text: "種別",
          sortable: false,
          value: "is_payment"
        },
        {
          text: "金額の既定値",
          sortable: false,
          value: "default_amount"
        },
        {
          text: "説明",
          sortable: false,
          value: "description"
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./personal/titles");
    this.titles = res.data;
  }
};
</script>
<style scoped></style>
