<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense @click="initForms()">
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title
        >{{ titleDetails.name }}の寮費免除率の既定値を変更</v-card-title
      >
      <v-card-subtitle v-html="subtitleMsg"></v-card-subtitle>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col>
              <v-text-field
                label="免除率"
                v-model="default_reward_pct"
                type="number"
                suffix="%"
              ></v-text-field>
            </v-col>
          </v-row>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="cancelEdit()">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="updateTitle()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["titleDetails"],
  data: function() {
    return {
      isDialogOpen: false,
      default_reward_pct: "",

      subtitleMsg:
        "<span style='color: red;'>委員会の報酬割合が永続的に変更された場合にのみ</span>編集してください。ある委員会期で一時的に報酬が変更された場合には、ここではなく役職記録から編集してください。"
    };
  },
  methods: {
    initForms() {
      this.default_reward_pct = this.titleDetails.default_reward_pct;
    },
    async updateTitle() {
      try {
        const res = await axios.put(`/role-titles/${this.titleDetails.id}`, {
          default_reward_pct: this.default_reward_pct
        });
      } catch (e) {
        console.error(e);
      }
      this.$emit("reloadTitles");
      this.isDialogOpen = false;
    },
    cancelEdit() {
      this.isDialogOpen = false;
    }
  }
};
</script>
<style scoped>
</style>
