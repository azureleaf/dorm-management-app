<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生大会委任状</v-card-title>
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
              <v-textarea
                name="reason"
                label="欠席理由"
                hint="アルバイトなどは欠席理由として認められません。また提出可能な回数は。この委任状を取り消すには。"
                v-model="absenceReason"
                outlined
              ></v-textarea>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-checkbox v-model="isHonestyConfirmed" label="以上の欠席理由に間違いはなく、虚偽申告が発覚した場合には懲罰を受けます。"></v-checkbox>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-btn color="primary" :disabled="!isHonestyConfirmed">提出</v-btn>
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
      isHonestyConfirmed: false,
      absenceReason: ""
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
