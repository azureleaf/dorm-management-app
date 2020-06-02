<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>会計区分別収支</span>
      <v-spacer></v-spacer>
      <v-btn color="error" depressed absolute right>
        <v-icon class="mr-1">mdi-plus-circle</v-icon>新しい会計区分の追加
      </v-btn>
    </v-card-title>
    <v-card-text>
      <v-row class="pb-5">
        <v-col> </v-col>
      </v-row>
      <v-data-table
        :headers="accountHeaders"
        :items="accounts"
        :items-per-page="20"
        :hide-default-footers="true"
      >
        <template v-slot:item.edit="{ item }">
          <account-table-edit-dialog
            :accountName="item.name"
            @retrieveAgain="retrieve"
            v-if="item.name !== '合計額'"
          ></account-table-edit-dialog>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      accounts: [
        {
          name: "一般会計",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "コンパ積立金",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "通信設備積立金",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "2020-01",
          end_at: "2021-12"
        },
        {
          name: "罰金会計",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345",
          start_at: "",
          end_at: ""
        },
        {
          name: "合計額",
          beginningBalance: "12345",
          income: "1000",
          expenditure: "5000",
          finalBalance: "8345"
        }
      ],
      accountHeaders: [
        {
          text: "会計区分",
          sortable: false,
          value: "name"
        },
        {
          text: "期首残高",
          sortable: false,
          value: "beginningBalance"
        },
        {
          text: "収入額",
          sortable: false,
          value: "income"
        },
        {
          text: "支出額",
          sortable: false,
          value: "expenditure"
        },
        {
          text: "期末残高",
          sortable: false,
          value: "finalBalance"
        },
        {
          text: "滞納分未収金",
          sortable: false,
          value: "arrears"
        },
        {
          text: "編集",
          sortable: false,
          value: "edit"
        }
      ]
    };
  },
  computed: {
    periodSelected() {
      return this.periods[this.periods.length - 1];
    }
  },
  methods: {
    retrieve() {
      console.log("retrieve!");
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
