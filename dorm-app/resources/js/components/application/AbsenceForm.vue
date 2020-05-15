<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生大会委任状</v-card-title>
        <v-card-subtitle>提出しても必ず認められるわけではありません。</v-card-subtitle>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <v-btn color="error" depressed absolute right>
                <v-icon class="mr-1">mdi-security</v-icon>委任状の集計と罰金処理
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              状態：
              <span v-if="isSubmitted">提出済</span>
              <span v-else-if="isOverLimit">提出不可（提出可能回数を超えています）</span>
              <span v-else-if="isOutsidePeriod">提出不可（次回の寮生大会日程が公示されていません）</span>
              <span v-else>提出可</span>
              <v-btn v-if="isSubmitted" color="primary" outlined @click="cancelAbsence()">取り消す</v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-textarea
                name="reason"
                label="欠席理由"
                hint="アルバイトなどは欠席理由として認められません。"
                v-model="absenceReason"
                outlined
              ></v-textarea>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-checkbox
                v-model="isHonestyConfirmed"
                :disabled="absenceReason.length == 0"
                label="以上の欠席理由に間違いはなく、虚偽申告が発覚した場合には懲罰を受けます。"
              ></v-checkbox>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-btn
                color="primary"
                :disabled="!isHonestyConfirmed || isSubmitted || isOutsidePeriod || isOverLimit"
                @click="isSubmitted = true"
              >提出</v-btn>
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
      isOutsidePeriod: false,
      isOverLimit: true,
      isSubmitted: false,
      isHonestyConfirmed: false,
      absenceReason: ""
    };
  },
  methods: {
    cancelAbsence() {
      this.isSubmitted = false;
      this.absenceReason = "";
      this.isHonestyConfirmed = false;
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
