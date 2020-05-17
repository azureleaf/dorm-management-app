<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>居室状況履歴</v-card-title>
        <v-card-text>
          <v-row class="mb-5 pb-5">
            <v-col>
              <dialog-box
                cardtitle="居室履歴登録"
                cardsubtitle="入寮・退寮の場合は寮生一覧を編集してください。その際の居室履歴は自動で更新されます。"
              >
                <template v-slot:dialogcontent>
                  <v-row>
                    <v-col cols="12" md="6">
                      <v-select :items="uniqueRooms" v-model="uniqueRoom" label="対象部屋番号 *" dense></v-select>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-select :items="updateTypes" v-model="updateType" label="更新事由 *" dense></v-select>
                    </v-col>
                  </v-row>
                  <v-row v-if="updateType == '部屋移動'">
                    <v-col cols="12" md="6">
                      <v-select :items="users" v-model="user" label="対象寮生 *" dense></v-select>
                    </v-col>
                    <v-col cols="12" md="6">
                      <v-select :items="uniqueRooms" v-model="uniqueRoom" label="移動先部屋番号 *" dense></v-select>
                    </v-col>
                  </v-row>
                  <v-row v-if="updateType == '点検'">
                    <v-col cols="12">
                      <v-text-field label="部屋の状態 *" v-model="comment" dense required></v-text-field>
                    </v-col>
                  </v-row>
                </template>
              </dialog-box>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="4">
              <v-text-field
                v-model="searchKeyword"
                append-icon="mdi-magnify"
                label="Search"
                single-line
                outlined
                dense
                hide-details
              ></v-text-field>
            </v-col>
          </v-row>
          <v-data-table
            :headers="roomHeaders"
            :items="rooms"
            :items-per-page="10"
            :search="searchKeyword"
          ></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      comment: "",
      isDialogOpen: false,
      searchKeyword: "",
      rooms: [],
      uniqueRooms: [101, 102, 103],
      uniqueRoom: "",
      updateTypes: ["部屋移動", "点検"],
      updateType: "",
      users: ["田中", "鈴木"],
      user: "",
      roomHeaders: [
        {
          text: "居室履歴ID",
          sortable: true,
          value: "id"
        },
        {
          text: "部屋番号",
          sortable: true,
          value: "room"
        },
        {
          text: "居住者",
          sortable: true,
          value: "user_id"
        },

        {
          text: "更新事由",
          sortable: true,
          value: "update_type"
        },
        {
          text: "更新日",
          sortable: true,
          value: "created_at"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./rooms");
    this.rooms = res.data;
  }
};
</script>
<style scoped>
table {
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
}
</style>
