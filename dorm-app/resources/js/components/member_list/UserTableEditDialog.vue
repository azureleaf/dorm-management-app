<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed v-on="on" dense :disabled="user.move_out_at != undefined">
        <v-icon class="mr-1">mdi-security</v-icon>
      </v-btn>
    </template>
    <v-card>
      <v-card-title>{{user.full_name}}さんの情報を更新</v-card-title>
      <v-card-text>
        <v-form>
          <v-row>
            <v-col>
              <v-select :items="operations" v-model="operation" label="処理内容" outlined></v-select>
            </v-col>
          </v-row>
          <v-container v-if="operation == '情報編集'">
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
                <v-text-field label="特記事項" v-model="comment"></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <v-container v-if="operation == 'パスワード変更'">
            <v-row>
              <v-col cols="12">
                <v-text-field
                  label="新しいパスワード"
                  v-model="password"
                  :append-icon="isPasswordMasked ? 'mdi-eye-off' : 'mdi-eye'"
                  :type="isPasswordMasked ? 'password' : 'text'"
                  @click:append="isPasswordMasked = !isPasswordMasked"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-container>
          <v-container v-else-if="operation == '部屋移動'">
            <v-row>
              <v-col>
                <v-select
                  :items="rooms"
                  v-model="room"
                  label="部屋移動先"
                  item-text="number"
                  item-value="id"
                  outlined
                ></v-select>
              </v-col>
            </v-row>
          </v-container>
          <v-container v-else-if="operation == '退寮処理'">
            <v-row justify="center">
              <v-subheader class>退寮日</v-subheader>
            </v-row>
            <v-row justify="center">
              <v-date-picker
                v-model="moveOutAt"
                locale="ja-jp"
                :day-format="date => new Date(date).getDate()"
                style="box-shadow: 0 0 0; border: solid 1px gainsboro"
              ></v-date-picker>
            </v-row>
          </v-container>
          <v-container v-else-if="operation == '役職編集'">
            <v-row justify="center">
              <v-subheader class>開始日</v-subheader>
            </v-row>
            <v-row justify="center">
              <v-date-picker
                v-model="moveOutAt"
                locale="ja-jp"
                :day-format="date => new Date(date).getDate()"
                style="box-shadow: 0 0 0; border: solid 1px gainsboro"
              ></v-date-picker>
            </v-row>
          </v-container>
        </v-form>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="cancelEdit()">Cancel</v-btn>
        <v-btn color="blue darken-1" text @click="updateUser()">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["user", "emaildomain"],
  data: function() {
    return {
      isDialogOpen: false,
      rooms: [],
      room: "",
      moveOutAt: "",
      name: {
        family: {
          kanji: "",
          kana: ""
        },
        first: {
          kanji: "",
          kana: ""
        }
      },
      email: "",
      password: "",
      isPasswordMasked: true,
      comment: "",
      operation: "情報編集",
      operations: [
        "情報編集",
        "パスワード変更",
        "部屋移動",
        "役職編集",
        "退寮処理"
      ]
    };
  },
  methods: {
    initForm() {
      this.email = this.user.email.replace(this.emaildomain, "");
      this.password = "";
      this.comment = this.user.comment;
      this.name.family.kanji = this.user.name_family_kanji;
      this.name.family.kana = this.user.name_family_kana;
      this.name.first.kanji = this.user.name_first_kanji;
      this.name.first.kana = this.user.name_first_kana;
      this.moveOutAt = new Date().toISOString().substr(0, 10);
    },
    async getAvailableRooms() {
      const res = await axios.get("./rooms/available");
      this.rooms = res.data;
    },
    async updateUser() {
      try {
        if (this.operation == "情報編集") {
          const res = await axios.post(`/update/user/${this.user.id}/names`, {
            name: this.name,
            email: this.email + this.emaildomain,
            comment: this.comment
          });
        } else if (this.operation == "パスワード変更") {
          const res = await axios.post(
            `/update/user/${this.user.id}/password`,
            {
              password: this.password // needs to be encrypted!
            }
          );
        } else if (this.operation == "部屋移動") {
          const res = await axios.post(
            `/update/user/${this.user.id}/transfer`,
            {
              old_room_id: this.user.room.id,
              new_room_id: this.room
            }
          );
        } else if (this.operation == "退寮処理") {
          /** Here need to check if the role, payment is clear! */
          const res = await axios.post(`/update/user/${this.user.id}/leave`, {
            move_out_at: this.moveOutAt
          });
        }
      } catch (e) {
        console.error(e);
      }
      this.$emit("reloadUsers");
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
    this.getAvailableRooms();
  }
};
</script>
<style scoped>
</style>
