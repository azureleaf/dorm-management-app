<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn
        color="error"
        depressed
        right
        absolute
        dark
        v-on="on"
        @click="initForms()"
      >
        <v-icon class="mr-1">mdi-security</v-icon>請求原稿の新規作成
      </v-btn>
    </template>
    <v-card>
      <v-card-title>決算日</v-card-title>
      <v-card-subtitle
        >決算日は必ず決算名目月の翌月のどこかに設定してください。</v-card-subtitle
      >
      <v-card-text>
        <v-container>
          <v-row justify="center">
            <v-date-picker
              v-model="picker"
              locale="ja-jp"
              :day-format="date => new Date(date).getDate()"
              style="box-shadow: 0 0 0; border: solid 1px gainsboro"
            ></v-date-picker>
          </v-row>
        </v-container>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false"
          >Cancel</v-btn
        >
        <v-btn color="blue darken-1" text @click="saveInput">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data: function() {
    return {
      picker: "",
      isDialogOpen: false
    };
  },
  methods: {
    saveInput() {
      this.isDialogOpen = false;
      this.$emit("setClosingDate", this.picker);
    },
    initForms() {
      this.picker = new Date().toISOString().substr(0, 10);
    }
  }
};
</script>
<style scoped>
</style>
