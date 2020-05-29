<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon>mdi-square-edit-outline</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{ roleHistory.user.full_name }}さんの役職を編集</v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              :items="roleTitles"
              v-model="role_title_id"
              label="職種"
              item-text="name"
              item-value="id"
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field label="寮費免除率" v-model="reward_pct" suffix="%"></v-text-field>
          </v-col>
        </v-row>
        <v-row justify="center">
          <v-subheader>以下で委員会期を選択すると開始日・終了日の既定値を自動入力できます。</v-subheader>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select :items="years" v-model="year" label="委員会年度（任意入力）" @change="autoInputTerm()"></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-select :items="terms" v-model="term" label="委員会期（任意入力）" @change="autoInputTerm()"></v-select>
          </v-col>
        </v-row>
        <v-row justify="center">
          <v-subheader class>開始日</v-subheader>
        </v-row>
        <v-row justify="center">
          <v-date-picker
            v-model="start_at"
            locale="ja-jp"
            :day-format="date => new Date(date).getDate()"
            style="box-shadow: 0 0 0; border: solid 1px gainsboro"
          ></v-date-picker>
        </v-row>
        <v-row justify="center">
          <v-subheader class>終了日</v-subheader>
        </v-row>
        <v-row justify="center">
          <v-date-picker
            v-model="end_at"
            locale="ja-jp"
            :day-format="date => new Date(date).getDate()"
            style="box-shadow: 0 0 0; border: solid 1px gainsboro"
          ></v-date-picker>
        </v-row>

        <v-row>
          <v-col cols="12">
            <v-text-field label="特記事項" v-model="comment"></v-text-field>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="updateRoleHistories()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["roleHistory"],
  data: function() {
    return {
      isAdmin: true,
      isDialogOpen: false,
      start_at: this.roleHistory.start_at,
      end_at: this.roleHistory.end_at,
      comment: this.roleHistory.comment,
      reward_pct: this.roleHistory.reward_pct,
      role_title_id: this.roleHistory.role_title_id,
      roleTitles: [],
      years: [
        new Date().getFullYear() - 1,
        new Date().getFullYear(),
        new Date().getFullYear() + 1
      ],
      year: new Date().getFullYear(),
      terms: ["I期", "II期", "III期"],
      term: ""
    };
  },
  methods: {
    async updateRoleHistories() {
      try {
        const res = await axios.post("/update/rolehx/" + this.roleHistory.id, {
          start_at: this.start_at,
          end_at: this.end_at,
          comment: this.comment,
          role_title_id: this.role_title_id,
          reward_pct: this.reward_pct
        });
      } catch (e) {
        console.error(e);
      }
      // now that the DB is updated, reload the table in the parent component
      this.$emit("retrieveAgain");
      this.isDialogOpen = false;
    },
    async loadTitles() {
      const res = await axios.get("./roletitles");
      this.roleTitles = res.data;
    },
    autoInputTerm() {
      if (this.year == "" || this.term == "") return;
      switch (this.term) {
        case "I期":
          this.start_at = this.year + "-06-01";
          this.end_at = this.year + "-09-30";
          break;
        case "II期":
          this.start_at = this.year + "-10-01";
          this.end_at = this.year + 1 + "-01-31";
          break;
        case "III期":
          this.start_at = this.year + 1 + "-02-01";
          this.end_at = this.year + 1 + "-05-31";
          break;
      }
    }
  },
  mounted: function() {
    this.loadTitles();
  }
};
</script>
<style scoped>
</style>
