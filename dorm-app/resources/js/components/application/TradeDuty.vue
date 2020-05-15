<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>当番変更届</v-card-title>
        <v-card-subtitle>当事者同士の話し合いで当番を交代した場合に報告してください。</v-card-subtitle>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="2">
              <v-select :items="formTypes" v-model="formTypeSelected" label="当番の種類"></v-select>
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
      formTypeSelected: "",
      formTypes: ["風呂掃除", "ブロック掃除", "脱衣所掃除"]
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
