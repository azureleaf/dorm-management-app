<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生一覧</v-card-title>
        <v-card-text>
          <v-row class="pb-5">
            <v-col>
              <user-table-registry-dialog @reloadUsers="loadUsers"></user-table-registry-dialog>
            </v-col>
          </v-row>
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
            <v-checkbox v-model="showCurrentUsers" label="現在の寮生" class="ml-5"></v-checkbox>
            <v-checkbox v-model="showFormerUsers" label="過去の寮生" class="ml-5"></v-checkbox>
          </v-row>
          <v-data-table
            :headers="userHeaders"
            :items="users"
            :items-per-page="10"
            :search="searchKeyword"
          >
            <template v-slot:item.edit="{item}">
              <user-table-edit-dialog :item="item"></user-table-edit-dialog>
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
      searchKeyword: "",
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
          value: "full_name",
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
          value: "room.number",
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
  methods: {
    async loadUsers() {
      const res = await axios.get("./users");
      this.users = res.data;
    }
  },
  mounted: function() {
    this.loadUsers();
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
