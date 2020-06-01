<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{ accountName }}の編集</v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12"> </v-col>
        </v-row>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false"
          >Cancel</v-btn
        >
        <v-btn color="blue darken-1" text @click="updateRoomStatus()"
          >Save</v-btn
        >
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["accountName"],
  data: function() {
    return {
      isAdmin: true,
      isDialogOpen: false
    };
  },
  methods: {
    async updateRoomStatus() {
      // try {
      //   const res = await axios.post("/edit/room/status/" + this.item.id, {
      //     comment: this.comment,
      //     status: this.status
      //   });
      // } catch (e) {
      //   console.error(e);
      // }

      // Now that the DB is updated, reload the table in the parent component
      this.$emit("retrieveAgain");
      this.isDialogOpen = false;
    }
  }
};
</script>
<style scoped>
</style>
