<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>居室履歴</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="4">
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
            :headers="roomHxHeaders"
            :items="roomHxs"
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
      searchKeyword: "",
      roomHxs: [],
      roomHxHeaders: [
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
    this.roomHxs = res.data;
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
