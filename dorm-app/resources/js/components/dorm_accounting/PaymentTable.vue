<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>現金出納</v-card-title>
        <v-card-text>
          <v-row>
            <v-col>
              <v-dialog v-model="isDialogOpen" persistent max-width="600px">
                <template v-slot:activator="{ on }">
                  <v-btn color="error" depressed right absolute dark v-on="on">
                    <v-icon class="mr-1">mdi-security</v-icon>現金出納登録
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>
                    <span class="headline">現金の出入りを登録します</span>
                  </v-card-title>
                  <v-card-text>
                    <v-container>
                      <v-row>
                        <v-col>
                          <v-radio-group v-model="isExpenditure" row>
                            <v-radio
                              v-for="isEx in [false, true]"
                              :key="isEx"
                              :label="isEx ? '支出' : '収入'"
                              :value="isEx"
                            ></v-radio>
                          </v-radio-group>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-select
                            :items="paymentCats"
                            item-text="name"
                            v-model="paymentCatSelected"
                            label="科目 *"
                          ></v-select>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-select :items="years" v-model="yearSelected" label="年 *"></v-select>
                        </v-col>
                        <v-col cols="12" md="6">
                          <v-select :items="months" v-model="monthSelected" label="月 *"></v-select>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12" md="6">
                          <v-text-field label="摘要 *" v-model="abstract" :disabled="isPaymentMonthly" required></v-text-field>
                        </v-col>
                        <v-col cols="12" md="6">
                          <v-text-field label="金額 *" v-model="amount" required></v-text-field>
                        </v-col>
                      </v-row>
                      <v-row>
                        <v-col cols="12">
                          <v-text-field label="特記事項" v-model="comment"></v-text-field>
                        </v-col>
                      </v-row>
                    </v-container>
                  </v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="saveInput">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-data-table :headers="billingHeaders" :items="billItems" :items-per-page="20"></v-data-table>
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
  methods: {
    saveInput() {
      this.initForms();
      this.isDialogOpen = false;
    },
    initForms() {
      this.comment = "";
      this.abstractEdited = "";
      this.amount = "";
      this.paymentCatSelected = "";
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
