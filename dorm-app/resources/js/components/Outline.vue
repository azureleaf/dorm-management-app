<template>
  <v-content>
    <v-container>
      <v-card>
        <v-card-title>要約</v-card-title>
        <v-card-text>
          <p>請求予定額</p>
          <p>前回の引き落し結果</p>
          <p>当番予定</p>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      users: "",
      userHeaders: [
         {
          text: "ID",
          sortable: true,
          value: "id"
        },
          {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "メールアドレス",
          sortable: false,
          value: "email"
        },
         {
          text: "部屋番号",
          sortable: true,
          value: ""
        },
         {
          text: "役職",
          sortable: true,
          value: ""
        },
      ]
    };
  },
  mounted: async function() {
    console.log("Component mountead.");
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
