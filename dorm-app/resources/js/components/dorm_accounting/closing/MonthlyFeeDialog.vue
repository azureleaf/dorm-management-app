<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>徴収総額の設定
      </v-btn>
    </template>
    <v-card>
      <v-card-title>徴収総額の設定</v-card-title>
      <v-card-text>
        <v-row>
          <v-col>
            <v-text-field
              label="徴収総額"
              v-model="totalAmount"
              type="number"
            ></v-text-field>
          </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false"
          >Cancel</v-btn
        >
        <v-btn color="blue darken-1" text @click="save"
          >Save</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  data: function() {
    return {
      totalAmount: null, // New amount inputted in the dialog form
      isDialogOpen: false,
    };
  },
  methods: {
    save() {
      this.$emit("setTotalAmount", this.totalAmount);
      this.isDialogOpen = false;
    }
  }
};
</script>
<style scoped></style>
