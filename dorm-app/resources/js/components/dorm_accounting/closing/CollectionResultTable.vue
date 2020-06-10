<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>寮費徴収結果</span>
      <v-spacer></v-spacer>
      <!-- <v-btn color="error" depressed absolute right>
        <v-icon class="mr-1">mdi-security</v-icon>徴収結果の登録
      </v-btn> -->
    </v-card-title>
    <v-card-subtitle
      >以下の未納請求一覧から、入金のあったものを選択してください。</v-card-subtitle
    >
    <v-card-text>
      <v-chip
        color="primary"
        outlined
        large
        label
        class="my-1 font-weight-bold"
      >
        選択項目の合計額：{{ formatCurrency(paidSum) }}
      </v-chip>
      <v-row>
        <v-col>
          <v-data-table
            :headers="unpaidHeaders"
            :items="unpaids"
            :items-per-page="20"
            show-select
            v-model="isPaid"
          >
            <template v-slot:item.amount="{ item }">
              {{ formatCurrency(item.amount) }}
            </template>
          </v-data-table>
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
      isPaid: [],
      unpaids: [],
      unpaidHeaders: [
        {
          text: "請求ID",
          sortable: false,
          value: "id"
        },
        {
          text: "氏名",
          sortable: false,
          value: "user.full_name"
        },
        {
          text: "決算期",
          sortable: false,
          value: "abstract"
        },
        {
          text: "金額",
          sortable: false,
          value: "amount"
        }
      ]
    };
  },
  computed: {
    paidSum() {
      return this.isPaid.reduce((acc, cur) => {
        return acc + cur.amount;
      }, 0);
    }
  },
  mounted: async function() {
    const res = await axios.get("./billings/unpaid");
    this.unpaids = res.data;
    console.log(res.data);
  }
};
</script>
<style scoped>
</style>
