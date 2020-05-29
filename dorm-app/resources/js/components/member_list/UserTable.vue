<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>寮生一覧</span>
          <v-spacer></v-spacer>
          <user-table-registry-dialog :emaildomain="emailDomain" @reloadUsers="loadUsers"></user-table-registry-dialog>
        </v-card-title>
        <v-card-text>
          <v-row>
            <v-spacer></v-spacer>
            <v-checkbox
              v-model="showCurrentUsers"
              @change="filterUsers()"
              label="現在の寮生"
              class="ml-5"
            ></v-checkbox>
            <v-checkbox
              v-model="showFormerUsers"
              @change="filterUsers()"
              label="過去の寮生"
              class="ml-5"
            ></v-checkbox>
            <v-col cols="12" md="4" lg="2">
              <v-text-field
                v-model="searchKeyword"
                append-icon="mdi-magnify"
                single-line
                outlined
                dense
                hide-details
              ></v-text-field>
            </v-col>
          </v-row>
          <v-data-table
            :headers="userHeaders"
            :items="usersShown"
            :items-per-page="10"
            :search="searchKeyword"
          >
            <template v-slot:item.edit="{item}">
              <user-table-edit-dialog
                :user="item"
                :emaildomain="emailDomain"
                @reloadUsers="loadUsers"
              ></user-table-edit-dialog>
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
      emailDomain: "@dc.aoba.ac.jp",
      showCurrentUsers: true,
      showFormerUsers: false,
      users: [],
      usersShown: [],
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
          text: "入寮日",
          sortable: true,
          value: "move_in_at",
          isAdminItem: true
        },
        {
          text: "退寮日",
          sortable: true,
          value: "move_out_at",
          isAdminItem: true
        },
        {
          text: "特記事項",
          sortable: false,
          value: "comment",
          isAdminItem: true
        },
        {
          text: "編集",
          sortable: false,
          value: "edit",
          isAdminItem: true
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
      this.filterUsers();
    },
    filterUsers() {
      this.usersShown = [];
      this.usersShown = this.usersShown.concat(
        this.users.filter(user => {
          if (this.showCurrentUsers) return user.move_out_at == undefined;
        })
      );
      this.usersShown = this.usersShown.concat(
        this.users.filter(user => {
          if (this.showFormerUsers) return user.move_out_at != undefined;
        })
      );
    }
  },
  mounted: async function() {
    await this.loadUsers();
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
