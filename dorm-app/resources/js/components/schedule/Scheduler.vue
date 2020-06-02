<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>日程希望提出</v-card-title>
        <v-card-subtitle>同じ項目について複数回提出した場合、最後の提出内容が適用されます。</v-card-subtitle>
        <v-card-text>
          <v-row>
            <v-col>
              <v-btn color="error" depressed absolute right>
                <v-icon class="mr-1">mdi-security</v-icon>日程希望調査の作成と削除
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-select :items="formTypes" v-model="formTypeSelected" label="受付中の日程希望調査"></v-select>
            </v-col>
          </v-row>
          <v-card outlined>
            <v-card-title>2020年５月風呂掃除</v-card-title>
            <v-card-text>
              <v-row>
                <v-col>
                  <v-btn color="error" depressed absolute right>
                    <v-icon class="mr-1">mdi-security</v-icon>調査結果の集計
                  </v-btn>
                </v-col>
              </v-row>
              <v-row>
                <v-col>受付期間：</v-col>
              </v-row>
              <v-checkbox v-model="pickAll" label="全選択"></v-checkbox>
              <v-row>
                <v-col>
                  <v-date-picker v-model="picker" multiple></v-date-picker>
                </v-col>
              </v-row>
              <v-row>
                <v-col>
                  <v-btn color="primary">以上の内容で日程希望を提出する</v-btn>
                </v-col>
              </v-row>
            </v-card-text>
          </v-card>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      picker: [new Date().toISOString().substr(0, 10)],
      pickAll: false,
      formTypeSelected: "",
      formTypes: [
        "風呂掃除希望調査",
        "ブロック掃除希望調査",
        "脱衣所掃除希望調査",
        "日程希望調査",
        "長期不在届",
        "コンパ日程希望調査"
      ],
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
