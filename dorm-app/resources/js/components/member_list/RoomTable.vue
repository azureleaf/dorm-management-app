<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>居室状況</v-card-title>
        <v-card-text>
          <v-data-table :headers="roomHeaders" :items="rooms" :items-per-page="10" >
            <template v-slot:item.edit="{item}">
              <room-table-dialog :item="item" @retrieveAgain="retrieve"></room-table-dialog>
            </template>
            <template v-slot:item.status="{item}">
              <v-icon v-if="item.status == 'vacant'" color="green" class="vmid">mdi-check-circle</v-icon>
              <v-icon v-else-if="item.status == 'occupied'" color="blue" class="vmid">mdi-account-circle</v-icon>
              <v-icon
                v-else-if="item.status == 'unavailable'"
                color="red"
                class="vmid"
              >mdi-close-circle</v-icon>
              <span class="vmid">{{ roomStatusJa(item.status) }}</span>
            </template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      isAdmin: true,
      isDialogOpen: false,
      rooms: [],
      statuses: [
        { en: "occupied", ja: "使用中" },
        { en: "vacant", ja: "空室" },
        { en: "unavailable", ja: "使用不能" }
      ],
      roomHeaders: [
        {
          text: "居室ID",
          sortable: true,
          value: "id"
        },
        {
          text: "部屋番号",
          sortable: true,
          value: "number"
        },
        {
          text: "居住可否",
          sortable: true,
          value: "status"
        },
        {
          text: "居住者",
          sortable: true,
          value: "user.full_name"
        },
        {
          text: "所属ブロック",
          sortable: true,
          value: "block"
        },
        {
          text: "設備状態",
          sortable: true,
          value: "comment"
        }
      ]
    };
  },
  methods: {
    roomStatusJa(roomStatusEn) {
      // translate DB expression to readable Japanese text
      const i = this.statuses.map(word => word.en).indexOf(roomStatusEn);
      if (i == -1)
        console.error("Error: room status'", roomStatusEn, "' is unknown.");
      return this.statuses[i].ja;
    },
    async retrieve() {
      const res = await axios.get("./rooms");
      this.rooms = res.data;
    }
  },
  mounted: async function() {
    if (this.isAdmin) {
      // add admin-only columns
      this.roomHeaders.push({
        text: "編集",
        sortable: false,
        value: "edit"
      });
    }
    this.retrieve();
  }
};
</script>
<style scoped>
.vmid {
  vertical-align: middle;
}
</style>
