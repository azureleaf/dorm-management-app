<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-security</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{item.name}}さんの情報編集</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <v-select :items="operations" v-model="operation" label="処理内容 *" dense outlined></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field label="居室の状態" v-model="comment"></v-text-field>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["item"],
  data: function() {
    return {
      isDialogOpen: false,
      comment: "",
      operation: "",
      operations: ["退寮", "部屋の移動", "役職の変更", "基本情報の変更"]
    };
  }
};
</script>
<style scoped>
</style>
