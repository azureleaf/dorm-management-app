<template>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <table>
            <tr>
              <th>摘要</th>
              <th>請求額</th>
              <th>支払額</th>
            </tr>
            <tr>
              <td>５月分寮費</td>
              <td>25000</td>
              <td></td>
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
