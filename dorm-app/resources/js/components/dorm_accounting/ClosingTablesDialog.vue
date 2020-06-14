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
      <v-card-title>決算原稿の新規作成</v-card-title>
      <v-card-subtitle
        >決算日は必ず決算名目月の翌月に設定するのが基本です。</v-card-subtitle
      >
      <v-card-text>
        <v-container>
          <v-row justify="center">
            <v-subheader>決算日の設定</v-subheader>
          </v-row>
          <v-row justify="center">
            <v-date-picker
              v-model="picker"
              locale="ja-jp"
              :day-format="date => new Date(date).getDate()"
              style="box-shadow: 0 0 0; border: solid 1px gainsboro"
              @change="fillTerm"
            ></v-date-picker>
          </v-row>
          <v-row justify="center">
            <v-subheader>決算期の設定</v-subheader>
          </v-row>
          <v-row justify="center">
            <v-col>
              <v-text-field
                label=""
                v-model="year"
                type="number"
                suffix="年"
              ></v-text-field
            ></v-col>
            <v-col>
              <v-text-field
                label=""
                v-model="month"
                type="number"
                suffix="月分決算"
              ></v-text-field>
            </v-col>
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
      year: null,
      month: null, // January is 1
      isDialogOpen: false
    };
  },
  methods: {
    fillTerm() {
      const d = new Date(this.picker);
      d.setDate(1); // first day of the month
      d.setHours(-1); // last day of the prev month
      this.year = d.getFullYear();
      this.month = d.getMonth() + 1;
    },
    saveInput() {
      this.isDialogOpen = false;
      this.$emit("setClosingDate", {
        closingDate: this.picker,
        year: this.year,
        month: this.month
      });
    },
    initForms() {
      this.picker = new Date().toISOString().substr(0, 10);
      this.fillTerm();
    }
  }
};
</script>
<style scoped>
</style>
