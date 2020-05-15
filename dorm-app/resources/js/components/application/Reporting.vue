<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>当番実施報告</v-card-title>
        <v-card-text>
           <v-row class="pb-5">
            <v-col>
              <v-btn color="error" depressed absolute right>
                <v-icon class="mr-1">mdi-security</v-icon>実施結果の罰金処理
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="2">
              <v-select :items="formTypes" v-model="formTypeSelected" label="実施報告の種別"></v-select>
            </v-col>
          </v-row>
          <v-radio-group v-model="isMyDuty">
            <v-radio
              v-for="ans in [true, false]"
              :key="ans"
              :label="ans ? dutyText[0] : dutyText[1]"
              :value="ans"
            ></v-radio>
          </v-radio-group>
          <v-row>
            <v-col>
              <v-date-picker v-model="picker"></v-date-picker>
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
      picker: new Date().toISOString().substr(0, 10),
      dutyText: [
        "自分の担当を実施しました。",
        "無断欠席した他の寮生の業務を代行しました。（欠席寮生への罰金と代行寮生への報酬が発生します。交代した場合は「当番変更届」をだしてください）"
      ],
      isMyDuty: true,
      formTypeSelected: "",
      formTypes: ["風呂掃除", "ブロック掃除", "脱衣所掃除"],
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
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
