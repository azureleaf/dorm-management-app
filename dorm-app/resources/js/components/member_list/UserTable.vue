<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生一覧</v-card-title>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <v-dialog v-model="isDialogOpen" persistent max-width="600px">
                <template v-slot:activator="{ on }">
                  <v-btn color="error" depressed right absolute dark v-on="on">
                    <v-icon class="mr-1">mdi-security</v-icon>新入寮生登録
                  </v-btn>
                </template>
                <v-card>
                  <v-card-title>新入寮生登録</v-card-title>
                  <v-card-text></v-card-text>
                  <v-card-actions>
                    <v-spacer></v-spacer>
                    <v-btn color="blue darken-1" text @click="isDialogOpen = false">Cancel</v-btn>
                    <v-btn color="blue darken-1" text @click="isDialogOpen = false">Save</v-btn>
                  </v-card-actions>
                </v-card>
              </v-dialog>
            </v-col>
          </v-row>
          <v-row>
            <v-checkbox v-model="showCurrentUsers" label="現在の寮生" class="ml-5"></v-checkbox>
            <v-checkbox v-model="showFormerUsers" label="過去の寮生" class="ml-5"></v-checkbox>
          </v-row>
          <v-data-table :headers="userHeaders" :items="users" :items-per-page="10">
            <template v-slot:item.edit="{item}">
              <user-table-dialog :item="item"></user-table-dialog>
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
      showCurrentUsers: true,
      showFormerUsers: false,
      users: [],
      userHeadersAll: [
        {
          text: "寮生ID",
          sortable: true,
          value: "id",
          isAdminItem: false
        },
        {
          text: "名前",
          sortable: true,
          value: "name",
          isAdminItem: false
        },
        {
          text: "メールアドレス",
          sortable: false,
          value: "email",
          isAdminItem: true
        },
        {
          text: "部屋番号",
          sortable: true,
          value: "room.room",
          isAdminItem: false
        },
        {
          text: "現職",
          sortable: true,
          value: "role",
          isAdminItem: false
        },
        {
          text: "編集",
          sortable: false,
          value: "edit",
          isAdminItem: false
        }
      ]
    };
  },
  computed: {
    userHeaders() {
      // show all the columns for admin
      if (this.isAdmin) return this.userHeadersAll;
      // hide several columns for non-admins
      else return this.userHeadersAll.filter(header => !header.isAdminItem);
    }
  },
  mounted: async function() {
    const res = await axios.get("./users");
    this.users = res.data;
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
