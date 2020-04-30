<template>
  <v-container>
    <v-app-bar class="teal darken-4" dense dark app>
      <v-avatar>
        <v-img class="mx-2" :src="avatarurl" max-height="50" max-width="50" contain></v-img>
      </v-avatar>
      <v-toolbar-title class="ml-5">
        <span>青葉寮運営管理系統</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items id="tb-items">
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="px-5">Home</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/userlist" class="px-5">寮生リスト</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/personalbook" class="px-5">会計履歴</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="px-5">会計処理</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="px-5">当番申請</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="px-5">当番表</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/login" class="px-6">ログイン</v-btn>
        <v-divider vertical></v-divider>
      </v-toolbar-items>
    </v-app-bar>
  </v-container>
</template>

<script>
export default {
  props: ["avatarurl"],
  data: function() {
    return {};
  },
  mounted: function() {
    console.log("URL:", this.avatarurl);
  }
};
</script>
<style scoped>
</style>
