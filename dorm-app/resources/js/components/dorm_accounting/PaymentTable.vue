<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>出納帳</v-card-title>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <v-dialog v-model="isDialogOpen" persistent max-width="600px">
                <template v-slot:activator="{ on }">
                  <v-btn color="error" depressed right absolute dark v-on="on">
                    <v-icon class="mr-1">mdi-security</v-icon>出納登録
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">収支項目登録</span>
                  </v-card-title>
                  <v-card-subtitle>寮費収入はここではなく「徴収結果の登録」から。</v-card-subtitle>
                  <v-card-text>
                    <v-container>
                      <v-row justify="center">
                        <v-date-picker
                          v-model="picker"
                          landscape
                          locale="ja-jp"
                          :day-format="date => new Date(date).getDate()"
                          style="box-shadow: 0 0 0; border: solid 1px gainsboro"
                        ></v-date-picker>
                      </v-row>
                      <v-row justify="center">
                        <v-radio-group v-model="isExpenditure" row>
                          <v-radio
                            v-for="isEx in [false, true]"
                            :key="isEx"
                            :label="isEx ? '支出' : '収入'"
                            :value="isEx"
                          ></v-radio>
                        </v-radio-group>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-select :items="accounts" v-model="account" label="会計区分 *" dense></v-select>
                        </v-col>
                        <v-col cols="12" md="6">
                          <v-select
                            :items="paymentCats"
                            item-text="name"
                            v-model="paymentCatSelected"
                            label="科目 *"
                            dense
                          ></v-select>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="3">
                          <v-select :items="years" v-model="yearSelected" label="年 *" dense></v-select>
                        </v-col>
                        <v-col cols="12" md="3">
                          <v-select :items="months" v-model="monthSelected" label="月 *" dense></v-select>
                        </v-col>
                        <v-col cols="12" md="6">
                          <v-text-field label="摘要 *" v-model="abstract" dense required></v-text-field>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-text-field label="金額 *" v-model="amount" required></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="saveInput">Delete</v-btn>
                    <v-btn color="blue darken-1" text @click="saveInput">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
              <v-snackbar v-model="isSnackbarOpen">
                入出金を登録しました
                <v-btn color="pink" text @click="isSnackbarOpen = false">Close</v-btn>
              </v-snackbar>
            </v-col>
          </v-row>
          <v-row class="pb-5">
            <v-col>
              <v-btn color="error" depressed absolute right>
                <v-icon class="mr-1">mdi-security</v-icon>徴収結果の登録
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20">
                <template v-slot:item.abstract="{item}">
                  <a v-if="isAdmin" :href="editorURL(item.id)">{{item.abstract}}</a>
                  <span v-else>{{item.abstract}}</span>
                </template>
              </v-data-table>
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
      account: "一般会計",
      accounts: ["一般会計", "コンパ積立金", "罰金会計"],
      picker: new Date().toISOString().substr(0, 10),
      isSnackbarOpen: false,
      comment: "",
      abstractEdited: "",
      amount: "",
      isExpenditure: true,
      monthSelected: new Date().getMonth() + 1 + "月分",
      yearSelected: new Date().getFullYear() + "年",
      paymentCats: [
        { name: "寄宿料", isMonthly: true },
        { name: "電気料金", isMonthly: true },
        { name: "水道料金", isMonthly: true },
        { name: "ガス料金", isMonthly: true },
        { name: "議長手当", isMonthly: true },
        { name: "灯油料金", isMonthly: true },
        { name: "銀行手数料", isMonthly: true },
        { name: "新聞料金", isMonthly: true },
        { name: "ネット管理代", isMonthly: true },
        { name: "共通棟重油代", isMonthly: true },
        { name: "共通棟ガス代", isMonthly: true },
        { name: "コンパ代", isMonthly: false },
        { name: "寮費返還", isMonthly: false },
        { name: "雑支出", isMonthly: false }
      ],
      paymentCatSelected: "",
      isDialogOpen: false,
      billItems: [],
      billingHeaders: [
        {
          text: "出納ID",
          sortable: true,
          value: "id"
        },
        {
          text: "発生日",
          sortable: true,
          value: "accrued_at"
        },
        {
          text: "決算期",
          sortable: true,
          value: ""
        },
        {
          text: "会計",
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
  methods: {
    saveInput() {
      this.isSnackbarOpen = true;
      this.initForms();
      this.isDialogOpen = false;
    },
    initForms() {
      this.comment = "";
      this.abstractEdited = "";
      this.amount = "";
      this.paymentCatSelected = "";
    },
    editorURL(paymentId) {
      // create link URL to edit clicked payment item
      return `/edit/payment/${paymentId}`;
    }
  },
  computed: {
    months() {
      // return list of formatted 12 months
      return [...Array(12).keys()].map(num => {
        return `${num + 1}月分`;
      });
    },
    years() {
      // when current year is 2020, return 2018, 2019, 2020
      return [...Array(3).keys()].map(num => {
        return `${new Date().getFullYear() - 2 + num}年`;
      });
    },
    isPaymentMonthly() {
      // tell if the payment category selected is monthly or not

      // when the category isn't selected yet
      if (!this.paymentCatSelected) return true;

      // get the index of the selected category in the original categories array
      const catIndex = this.paymentCats
        .map(cat => cat.name)
        .indexOf(this.paymentCatSelected);

      return this.paymentCats[catIndex].isMonthly;
    },
    abstract: {
      // default text for the "abstract" text field
      get: function() {
        if (this.isPaymentMonthly) {
          // for montly payments, fill with default string
          return (
            this.yearSelected + this.monthSelected + this.paymentCatSelected
          );
        } else {
          // for irregular payments, leave the field blank and let the user fill
          return "";
        }
      },
      set: function(newVal) {
        this.abstractEdited = newVal;
      }
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
