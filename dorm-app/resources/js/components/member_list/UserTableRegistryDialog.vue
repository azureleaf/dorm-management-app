<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-plus-circle</v-icon>新入寮生登録
      </v-btn>
    </template>
    <v-card>
      <v-card-title>新入寮生登録</v-card-title>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col cols="6">
              <v-text-field label="名字" v-model="name.family.kanji"></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field label="名前" v-model="name.first.kanji"></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="6">
              <v-text-field label="みょうじ" v-model="name.family.kana"></v-text-field>
            </v-col>
            <v-col cols="6">
              <v-text-field label="なまえ" v-model="name.first.kana"></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-text-field label="メールアドレス" v-model="email" :suffix="emaildomain"></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12">
              <v-text-field
                label="パスワード"
                v-model="password"
                :append-icon="isPasswordMasked ? 'mdi-eye-off' : 'mdi-eye'"
                :type="isPasswordMasked ? 'password' : 'text'"
                @click:append="isPasswordMasked = !isPasswordMasked"
              ></v-text-field>
            </v-col>
          </v-row>
          <v-row>
            <v-col>
              <v-select
                :items="rooms"
                v-model="room"
                label="居室"
                item-text="number"
                item-value="id"
                outlined
              ></v-select>
            </v-col>
          </v-row>
          <v-row justify="center">
            <v-subheader>入寮日</v-subheader>
          </v-row>
          <v-row justify="center">
            <v-date-picker
              v-model="moveInAt"
              locale="ja-jp"
              :day-format="date => new Date(date).getDate()"
              style="box-shadow: 0 0 0; border: solid 1px gainsboro"
            ></v-date-picker>
          </v-row>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="registerNewComer()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: [
    "emaildomain"
  ],
  data: function() {
    return {
      moveInAt: new Date().toISOString().substr(0, 10),
      rooms: [],
      room: "",
      name: {
        family: { kanji: "", kana: "" },
        first: { kanji: "", kana: "" }
      },
      email: "",
      password: "", // needs to be encrypted before submission!
      isDialogOpen: false,
      isPasswordMasked: true,
    };
  },
  methods: {
    async getAvailableRooms() {
      const res = await axios.get("./rooms/available");
      this.rooms = res.data;
    },
    async registerNewComer() {
      try {
        const res = await axios.post("/create/user", {
          name: this.name,
          room_id: this.room,
          move_in_at: this.moveInAt,
          password: this.password,
          email: this.email + this.emaildomain
        });
      } catch (e) {
        console.error(e);
      }
      this.$emit("reloadUsers");
      this.isDialogOpen = false;
    }
  },
  mounted: function() {
    this.getAvailableRooms();
  }
};
</script>
<style scoped>
</style>
