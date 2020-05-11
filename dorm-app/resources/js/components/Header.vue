<template>
  <v-container>
    <v-app-bar class="blue darken-4" dense dark app>
      <v-avatar>
        <v-img class="mx-2" :src="avatarurl" max-height="50" max-width="50" contain></v-img>
      </v-avatar>
      <v-toolbar-title class="ml-5">
        <span>Hirosegawa Digital Service</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items id="tb-items">
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="px-5">早見表</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/userlist" class="px-5">寮生名簿</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/personalbook" class="px-5">個人会計</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/dormbook" class="px-5">寮会計</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/duty" class="px-5">当番処理</v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/logout" class="px-6">ログアウト</v-btn>
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
