<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-img
          class="white--text align-end"
          height="200px"
          src="https://cdn.vuetifyjs.com/images/cards/house.jpg"
        >
          <v-card-title>青葉大学青葉寮公式サイトへようこそ！</v-card-title>
        </v-img>
        <v-card-text>
          <p>仙台市にある青葉大学の男子寮・青葉寮の公式ウェブサイトです。入寮をお考えの皆さまに当寮をご紹介いたします。</p>
          <p>在寮生には青葉寮電子情報サービスを提供します。利用するにはログインしてください。</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10">
        <v-card-title>基本情報</v-card-title>
        <v-card-text>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10">
        <v-card-title>設備</v-card-title>
        <v-card-text>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10">
        <v-card-title>特長</v-card-title>
        <v-card-text>
          <h3>静か</h3>
          <p>静か</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10">
        <v-card-title>年間行事</v-card-title>
        <v-card-text>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10">
        <v-card-title>寮生のおしごと</v-card-title>
        <v-card-text>
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
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped>
.v-card {
  margin-bottom: 30px;
}
</style>
