<!--
  Dialog component for 2 modes of role histories table:
    mode to create a new history,
    mode to update an existing history
-->
<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn v-if="isCreation" color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-plus-circle</v-icon>
        <span>役職記録の新規作成</span>
      </v-btn>
      <v-btn v-if="!isCreation" color="error" depressed dark v-on="on" dense>
        <v-icon>mdi-square-edit-outline</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title v-if="!isCreation">{{ currHistory.user.full_name }}さんの役職を編集</v-card-title>
      <v-card-title v-if="isCreation">役職記録の新規作成</v-card-title>
      <v-card-subtitle v-if="isCreation">期の途中で報酬が代わる場合などは、２つの別々の役職で登録してください。</v-card-subtitle>
      <v-card-text>
        <v-row v-if="isCreation">
          <v-col cols="12" md="6">
            <v-select
              :items="users"
              v-model="user_id"
              label="対象寮生"
              item-text="readableName"
              item-value="id"
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              :items="roleTitles"
              v-model="role_title_id"
              label="職種"
              item-text="name"
              item-value="id"
              @change="autofillReward()"
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field label="寮費免除率" v-model="reward_pct" type="number" suffix="%"></v-text-field>
          </v-col>
        </v-row>
        <v-row justify="center">
          <v-subheader>以下で委員会期を選択すると開始日・終了日の既定値を自動入力できます。</v-subheader>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select :items="years" v-model="year" label="委員会年度（任意入力）" @change="autofillTerm()"></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-select :items="terms" v-model="term" label="委員会期（任意入力）" @change="autofillTerm()"></v-select>
          </v-col>
        </v-row>
        <v-row justify="center">
          <v-subheader>開始日</v-subheader>
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
          <v-subheader>終了日</v-subheader>
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
        <v-btn color="blue darken-1" text @click="cancelEdit()">Cancel</v-btn>
        <v-btn v-if="isCreation" color="blue darken-1" text @click="createRoleHx()">Save</v-btn>
        <confirmation-dialog
          v-if="!isCreation"
          confirmationTitle="削除確認"
          :confirmationMsg="confirmationMsg"
          @isConfirmed="deleteRoleHx()"
        ></confirmation-dialog>
        <v-btn v-if="!isCreation" color="blue darken-1" text @click="updateRoleHx()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["isCreation", "currHistory"],
  data: function() {
    return {
      isAdmin: true,
      isDialogOpen: false,
      isConfirmationDialogOpen: false,
      start_at: "",
      end_at: "",
      comment: "",
      reward_pct: "",
      role_title_id: "",
      roleTitles: [],
      user_id: "", // unused for update mode
      users: [], // unused for update mode
      years: [
        // Show 3 years as candidates
        new Date().getFullYear() - 1,
        new Date().getFullYear(),
        new Date().getFullYear() + 1
      ],
      year: new Date().getFullYear(),
      terms: ["I期", "II期", "III期"],
      term: ""
    };
  },
  computed: {
    confirmationMsg() {
      return `${this.currHistory.user.full_name}さんの${this.currHistory.role_title.name}の役職記録を削除します。本当によろしいですか？`;
    }
  },
  methods: {
    cancelEdit() {
      this.initForms();
      this.isDialogOpen = false;
    },
    async createRoleHx() {
      try {
        const res = await axios.post(
          `create/rolehx/${this.user_id}/${this.role_title_id}`,
          {
            start_at: this.start_at,
            end_at: this.end_at,
            comment: this.comment,
            reward_pct: this.reward_pct
          }
        );
      } catch (e) {
        console.error(e);
      }
      // now that the DB is updated, reload the table in the parent component
      this.$emit("retrieveAgain");
      this.initForms();
      this.isDialogOpen = false;
    },
    async updateRoleHx() {
      try {
        const res = await axios.post("/update/rolehx/" + this.currHistory.id, {
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
      this.initForms();
      this.isDialogOpen = false;
    },
    async deleteRoleHx() {
      try {
        const res = await axios.post(
          `delete/rolehx/${this.currHistory.id}`,
          {}
        );
      } catch (e) {
        console.error(e);
      }
      // now that the DB is updated, reload the table in the parent component
      this.$emit("retrieveAgain");
      this.initForms();
      this.isDialogOpen = false;
    },
    async loadRoleTitles() {
      const res = await axios.get("./roletitles");
      this.roleTitles = res.data;
    },
    async loadUsers() {
      const res = await axios.get("./users");

      // Filter out the leavers
      this.users = res.data.filter(user => {
        return user.move_out_at == undefined;
      });

      // Sort by room number
      this.users.sort((user1, user2) => {
        return Number(user1.room.number) - Number(user2.room.number);
      });

      // Give formatted description to specify the user easily
      this.users.forEach(user => {
        user["readableName"] = `${user.room.number}: ${user.full_name}`;
      });
    },
    // autofill the date of start & end of the role history
    autofillTerm() {
      // autofill only when the necessary info is supplied
      if (this.year == "" || this.term == "") return;

      // Note that the date format of v-date-picker is 2020-01-01
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
    },
    // autofill the default reward percentages
    autofillReward() {
      this.roleTitles.forEach(roleTitle => {
        if (roleTitle.id == this.role_title_id)
          this.reward_pct = roleTitle.default_reward_pct;
      });
    },
    // Clear the input forms and fill with the default values
    initForms() {
      this.user_id = "";
      this.start_at = this.isCreation ? "" : this.currHistory.start_at;
      this.end_at = this.isCreation ? "" : this.currHistory.end_at;
      this.comment = this.isCreation ? "" : this.currHistory.comment;
      this.reward_pct = this.isCreation ? "" : this.currHistory.reward_pct;
      this.role_title_id = this.isCreation
        ? ""
        : this.currHistory.role_title_id;
    }
  },
  mounted: function() {
    this.initForms();
    this.loadRoleTitles();
    this.loadUsers();
  }
};
</script>
<style scoped>
</style>
