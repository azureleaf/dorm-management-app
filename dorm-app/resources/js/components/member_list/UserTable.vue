<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生一覧</v-card-title>
        <v-card-text>
          <v-data-table :headers="userHeaders" :items="users" :items-per-page="20">
            <template v-slot:item.name="{item}">
              <a v-if="isAdmin" :href="editorURL(item.id, 'name')">{{ item.name }}</a>
              <span v-else>{{ item.name }}</span>
            </template>
            <template v-slot:item.room="{item}">
              <a v-if="isAdmin" :href="editorURL(item.id, 'room')">{{ item.room }}</a>
              <span v-else>{{ item.room }}</span>
            </template>
            <template v-slot:item.role="{item}">
              <a v-if="isAdmin" :href="editorURL(item.id, 'role')">{{ item.role }}</a>
              <span v-else>{{ item.role }}</span>
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
          value: "roomNum",
          isAdminItem: false
        },
        {
          text: "役職",
          sortable: true,
          value: "role",
          isAdminItem: false
        }
      ]
    };
  },
  methods: {
    editorURL(userId, dataType) {
      return `/edit/${dataType}/${userId}`;
    }
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
