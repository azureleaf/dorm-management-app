<!--
  Button to open a dialog box to confirm on the critical operation,
  such as deletion of a record
-->
<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="blue darken-1" text v-on="on">Delete</v-btn>
    </template>
    <v-card>
      <v-card-title>{{ confirmationTitle }}</v-card-title>
      <v-card-subtitle>{{ confirmationMsg }}</v-card-subtitle>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="cancelEdit()">中止</v-btn>
        <v-btn color="blue darken-1" text @click="confirm()">実行</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["confirmationTitle", "confirmationMsg"],
  data: function() {
    return {
        isDialogOpen: false,
    };
  },
  methods: {
    cancelEdit() {
      this.isDialogOpen = false;
    },
    confirm() {
      this.$emit("isConfirmed");
      this.isDialogOpen = false;
    }
  }
};
</script>
<style scoped>
</style>
