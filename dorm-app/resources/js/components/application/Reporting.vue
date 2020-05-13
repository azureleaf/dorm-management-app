<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>実施報告</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="2">
              <v-select :items="formTypes" v-model="formTypeSelected" label="申請内容"></v-select>
            </v-col>
          </v-row>
          <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      formTypeSelected: "",
      formTypes: [
        "風呂掃除",
        "ブロック掃除",
        "脱衣所掃除",
      ],
      billItems: [],
      billingHeaders: [
        {
          text: "処理登録日",
          sortable: true,
          value: "created_at"
        },
        {
          text: "決算期",
          sortable: true,
          value: ""
        },
        {
          text: "科目",
          sortable: true,
          value: "category"
        },

        {
          text: "摘要",
          sortable: true,
          value: "abstract"
        },
        {
          text: "収入",
          sortable: true,
          value: "billing"
        },
        {
          text: "支出",
          sortable: true,
          value: "payment"
        },

        {
          text: "残高",
          sortable: true,
          value: "balance"
        }
      ]
    };
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
