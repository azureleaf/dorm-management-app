<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>請求内訳</v-card-title>
        <v-card-subtitle>寮生個人への月々の請求額の内訳です。</v-card-subtitle>
        <v-card-text>
          <v-row>
            <v-spacer></v-spacer>
            <v-col cols="12" md="4" lg="2">
              <v-text-field
                v-model="searchKeyword"
                append-icon="mdi-magnify"
                single-line
                outlined
                dense
                hide-details
              ></v-text-field>
            </v-col>
          </v-row>
          <v-data-table
            :headers="billingHeaders"
            :items="billItems"
            :items-per-page="20"
            :search="searchKeyword"
          >
            <template v-slot:item.amount="{ item }">
              <span>{{ formatCurrency(item.amount) }}</span>
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
      searchKeyword: "",
      billItems: [],
      billingHeaders: [
        {
          text: "対象寮生ID",
          sortable: true,
          value: "billing.user_id"
        },
        {
          text: "対象寮生",
          sortable: true,
          value: "billing.user.full_name"
        },
        {
          text: "請求ID",
          sortable: true,
          value: "billing_id"
        },
        {
          text: "決算期",
          sortable: true,
          value: "billing.abstract"
        },
        {
          text: "寮費科目",
          sortable: true,
          value: "personal_account_title.name"
        },
        {
          text: "請求額",
          sortable: true,
          value: "amount"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billing-details");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
