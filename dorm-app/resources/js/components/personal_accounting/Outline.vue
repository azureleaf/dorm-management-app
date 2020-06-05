<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>納付状況</v-card-title>
        <v-card-text>
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
                      <span class="vmid">引落成功</span>
                    </span>
                    <span v-if="isPaidByCash" class="px-4">
                      <v-icon class="vmid" color="green"
                        >mdi-check-circle</v-icon
                      >
                      <span class="vmid">現金納付</span>
                    </span>
                    <span v-else class="px-4">
                      <v-icon class="vmid" color="red">mdi-close-circle</v-icon>
                      <span class="vmid">引落失敗</span>
                    </span>
                  </span>
                </v-list-item-title>
                <v-list-item-subtitle>2020-03-20</v-list-item-subtitle>
              </v-list-item-content>
            </v-list-item>
          </v-card>
          <v-data-table :headers="arrearHeaders" :items="arrears">
            <template v-slot:item.isNextDebit="{ item }">
              <v-checkbox
                :disabled="item.status == '新規請求分'"
                v-model="isSelected"
              ></v-checkbox>
            </template>
            <template v-slot:item.amount="{ item }">
              {{ formatCurrency(item.amount) }}
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
      users: "",
      selected: [],
      isSelected: "",
      isDebitSuccess: false,
      isPaidByCash: false,
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
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle;
}
</style>
