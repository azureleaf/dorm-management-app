<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>出納帳</v-card-title>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <payment-table-dialog></payment-table-dialog>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-data-table
                :headers="billingHeaders"
                :items="billItems"
                :items-per-page="10"
              ></v-data-table>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      isAdmin: true,
      billItems: [],
      billingHeaders: [
        {
          text: "出納ID",
          sortable: false,
          value: "id"
        },
        {
          text: "発生日",
          sortable: false,
          value: "accrued_at"
        },
        {
          text: "決算期",
          sortable: false,
          value: ""
        },
        {
          text: "会計",
          sortable: false,
          value: "account"
        },
        {
          text: "科目",
          sortable: false,
          value: "cat"
        },

        {
          text: "摘要",
          sortable: false,
          value: "abstract"
        },
        {
          text: "収入",
          sortable: false,
          value: "billing"
        },
        {
          text: "支出",
          sortable: false,
          value: "payment"
        },

        {
          text: "残高",
          sortable: false,
          value: "balance"
        },
        {
          text: "編集",
          sortable: false,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
