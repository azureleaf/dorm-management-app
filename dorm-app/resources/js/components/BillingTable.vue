<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <table>
            <tr>
              <th>ID</th>
              <th>摘要</th>
              <th>請求額</th>
              <th>支払額</th>
              <th>支払残高</th>
              <th>処理日</th>
              <th>更新日</th>
            </tr>
            <tr v-for="(billItem, index) in billItems" :key="index">
              <td>{{billItem.id}}</td>
              <td>{{billItem.abstract}}</td>
              <td>{{billItem.billItem}}</td>
              <td>{{billItem.payment}}</td>
              <td>{{billItem.balance}}</td>
              <td>{{billItem.created_at}}</td>
              <td>{{billItem.updated_at}}</td>
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
      billItems: ""
    };
  },
  mounted: async function() {
    console.log("Component mountead.");
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./billings");
    this.billItems = res.data;
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
