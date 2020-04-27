<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <table>
            <tr>
              <th>ID</th>
              <th>名前</th>
              <th>メールアドレス</th>
              <th>パスワードハッシュ</th>
            </tr>
            <tr v-for="(user, index) in users" :key="index">
              <td>{{user.id}}</td>
              <td>{{user.name}}</td>
              <td>{{user.email}}</td>
              <td>{{user.password}}</td>
            </tr>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: function() {
    return {
      users: ""
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

table, th, td {
  border: 1px solid black;
}
</style>
