<template>
  <v-card outlined>
    <v-card-title>
      <span>寮費徴収結果</span>
      <v-spacer></v-spacer>
      <v-btn color="error" depressed absolute right>
        <v-icon class="mr-1">mdi-security</v-icon>徴収結果の登録
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-row class="pb-5">
        <v-col>
          <!-- <payment-table-dialog></payment-table-dialog> -->
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="billingHeaders"
            :items="billItems"
            :items-per-page="20"
          ></v-data-table>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      isAdmin: true,
      billItems: [],
      billingHeaders: [
        {
          text: "寮会計ID",
          sortable: false,
          value: "id"
        },
        {
          text: "徴収日",
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
          text: "合計額",
          sortable: false,
          value: "amount"
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
