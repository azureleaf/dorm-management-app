<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>滞納者番付</v-card-title>
        <v-card-subtitle>寮費滞納は最も重大な規定違反です。債権回収措置が取られる前に速やかに返済してください。</v-card-subtitle>
        <!-- <v-toolbar flat class="white--text" color="grey darken-3" dense dark>滞納者番付</v-toolbar> -->
        <!-- <v-toolbar flat color="yellow lighten-5" dense>滞納者番付</v-toolbar> -->
        <v-card-text>
          <v-data-table :headers="userHeaders" :items="users" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      users: [],
      userHeaders: [
        {
          text: "部屋番号",
          sortable: true,
          value: ""
        },
        {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "滞納額",
          sortable: true,
          value: ""
        },
        {
          text: "滞納期間",
          sortable: true,
          value: ""
        },
        {
          text: "特記事項",
          sortable: true,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
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
