<template>
  <v-container>
    <v-app-bar class="blue darken-4" dense dark app>
      <v-avatar class="d-none d-md-flex d-lg-flex d-xl-flex">
        <v-img class="mx-2" :src="avatarurl" max-height="50" max-width="50" contain></v-img>
      </v-avatar>
      <v-toolbar-title class="ml-5 headline" style="font-family: 'Titillium Web' !important;">
        <span class="font-weight-black">Aobaryo</span>
        <span class="font-weight-light">Cloud</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items id="tb-items">
        <v-divider vertical></v-divider>
        <v-btn text href="/" class="mx-0 px-0" title="寮紹介">
          <v-icon>mdi-home</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">寮紹介</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/personalbook" class="px-0 mx-0"  title="個人記録">
          <v-icon class>mdi-account-circle</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">個人記録</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/dormbook" class="px-0" title="寮会計">
          <v-icon class>mdi-currency-jpy</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">寮会計</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/application" class="px-2" title="日程管理">
          <v-icon class>mdi-clock</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">日程管理</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/userlist" class="px-0" title="寮生名簿">
          <v-icon class>mdi-view-list</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">寮生名簿</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/archive" class="px-0" title="寮文書">
          <v-icon class>mdi-file-document</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">寮文書</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
        <v-btn text href="/logout" class="px-0" title="ログアウト">
          <v-icon class>mdi-lock-open</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">Logout</span> -->
        </v-btn>
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
    // console.log("URL:", this.avatarurl);
  }
};
</script>
<style scoped>
</style>
