<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>納付状況</v-card-title>
        <v-card-subtitle>
          請求から実際に引き落とされるまでは時間がかかるため、一ヶ月分未納状態となるのは通常の処理です。
          滞納している場合には、古い方から二ヶ月分を次回に引き落します。
          三ヶ月分以上滞納している場合には、以下のチェックボックスから選択することで三ヶ月分以上を引落予約することができます。
        </v-card-subtitle>
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
          <v-card flat outlined class="mb-4 pb-3">
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <span>次回の引落予定：</span>
                  <span>
                    <v-chip
                      label
                      outlined
                      large
                      color="indigo darken-1"
                      class="px-3"
                    >
                      <span class="headline ml-1">{{
                        formatCurrency(12345)
                      }}</span>
                    </v-chip>
                  </span>
                </v-list-item-title>
                <v-list-item-subtitle>2020-04-20</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card>
          <v-card flat outlined class="mb-4 py-3">
            <v-list-item>
              <v-list-item-content>
                <v-list-item-title>
                  <span>前回の納付結果：</span>
                  <span>
                    <span v-if="isDebitSuccess" class="px-4">
                      <v-icon class="vmid" color="green"
                        >mdi-check-circle</v-icon
                      >
                      <span class="vmid">納付済</span>
                    </span>
                    <span v-else class="px-4">
                      <v-icon class="vmid" color="red">mdi-close-circle</v-icon>
                      <span class="vmid">滞納中</span>
                    </span>
                  </span>
                </v-list-item-title>
                <v-list-item-subtitle>2020-03-20</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card>
          <v-data-table
            :headers="billingResultHeaders"
            :items="billingResults"
            :search="searchKeyword"
          >
            <template v-slot:item.amount="{ item }">
              <span>{{ formatCurrency(item.amount) }}</span>
            </template>
            <template v-slot:item.paid_at="{ item }">
              <span v-if="item.paid_at != null">
                <v-icon class="vmid" color="green">mdi-check-circle</v-icon>
                納付済（{{ item.paid_at }}）</span
              >
              <span v-else>
                <v-icon class="vmid" color="orange">mdi-alert-circle</v-icon>
                未納</span
              >
            </template>
            <template v-slot:item.is_next_debit_target="{ item }">
              <span v-if="item.paid_at == null">
                <v-checkbox
                  :disabled="item.is_next_debit_target"
                  v-model="isSelected"
                ></v-checkbox>
              </span>
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
      users: "",
      selected: [],
      isSelected: "",
      isDebitSuccess: false,
      isPaidByCash: false,
      billingResults: [],
      billingResultHeaders: [
        {
          text: "対象寮生",
          sortable: true,
          value: "user.full_name"
        },

        {
          text: "決算期",
          sortable: true,
          value: "abstract"
        },
        {
          text: "請求額",
          sortable: true,
          value: "amount"
        },
        {
          text: "状態",
          sortable: true,
          value: "paid_at"
        },
        {
          text: "次回引落",
          sortable: true,
          value: "is_next_debit_target"
        }
      ],
      arrearHeaders: [
        {
          text: "ID",
          sortable: true,
          value: "id"
        },
        {
          text: "請求日",
          sortable: true,
          value: "billed_at"
        },
        {
          text: "摘要",
          sortable: false,
          value: "abstract"
        },
        {
          text: "金額",
          sortable: false,
          value: "amount"
        },
        {
          text: "状態",
          sortable: false,
          value: "status"
        },
        {
          text: "次回引落",
          sortable: false,
          value: "isNextDebit"
        }
      ],
      arrears: [
        {
          id: 3,
          billed_at: "2020-04-01",
          abstract: "2020年３月分",
          amount: 12345,
          status: "新規請求分"
        },
        {
          id: 4,
          billed_at: "2020-04-01",
          abstract: "2020年３月分",
          amount: 12345,
          status: "新規請求分"
        },
        {
          id: 5,
          billed_at: "2020-04-01",
          abstract: "2020年３月分",
          amount: 12345,
          status: "滞納分"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billings");
    this.billingResults = res.data;
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle;
}
</style>
