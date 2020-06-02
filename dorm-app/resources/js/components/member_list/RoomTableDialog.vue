<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{ item.room }}号室の状態を編集</v-card-title>
      <v-card-text>
        <v-row>
          <v-col cols="12">
            <v-select
              :items="statuses"
              v-model="status"
              label="居住可否 *"
              dense
              :disabled="status == 'occupied'"
            ></v-select>
          </v-col>
        </v-row>
        <v-row>
          <v-col cols="12">
            <v-text-field
              label="部屋の状態の詳細説明"
              v-model="comment"
            ></v-text-field>
          </v-col>
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
  props: ["item"],
  data: function() {
    return {
      isAdmin: true,
      isDialogOpen: false,
      comment: this.item.comment,
      statuses: [
        { text: "使用中", value: "occupied", disabled: true },
        { text: "空室", value: "vacant" },
        { text: "使用不能", value: "unavailable" }
      ],
      status: this.item.status
    };
  },
  methods: {
    async updateRoomStatus() {
      try {
        const res = await axios.put(`/rooms/${this.item.id}`, {
          comment: this.comment,
          status: this.status
        });
      } catch (e) {
        console.error(e);
      }
      // now that the DB is updated, reload the table in the parent component
      this.$emit("retrieveAgain");
      this.isDialogOpen = false;
    }
  }
};
</script>
<style scoped>
</style>
