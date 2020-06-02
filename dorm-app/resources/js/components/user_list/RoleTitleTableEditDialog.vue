<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-security</v-icon>役職種別の編集
      </v-btn>
    </template>
    <v-card>
      <v-card-title>役職種別の編集</v-card-title>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col>
              <v-select
                :items="operations"
                item-value="value"
                item-text="text"
                v-model="operation"
                label="処理内容"
                outlined
              ></v-select>
            </v-col>
          </v-row>
          <v-container v-if="operation == 'create'">
            <v-row>
              <v-col cols="6">
                <v-text-field label="職種名" v-model="titleName"></v-text-field>
              </v-col>
              <v-col cols="6">
                <v-text-field label="既定の報酬率" v-model="rewardPct"></v-text-field>
              </v-col>
            </v-row>
          </v-container>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="cancelEdit()">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="updateTitles()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["titles"],
  data: function() {
    return {
      isDialogOpen: false,
      titleName: "",
      rewardPct: "",
      operation: "",
      operations: [
        { value: "create", text: "新規作成" },
        { value: "edit", text: "役職編集" },
      ]
    };
  },
  methods: {
    initForm() {},
    async updateTitles() {
      try {
        if (this.operation == "create") {
          const res = await axios.post(`/create/roletitle/`, {
            titleName: this.titleName,
            rewardPct: this.rewardPct,
          });
        } 
      } catch (e) {
        console.error(e);
      }
      this.$emit("reloadTitles");
      this.initForm();
      this.isDialogOpen = false;
    },
    cancelEdit() {
      this.initForm();
      this.isDialogOpen = false;
    }
  },
  mounted: function() {
    this.initForm();
  }
};
</script>
<style scoped>
</style>
