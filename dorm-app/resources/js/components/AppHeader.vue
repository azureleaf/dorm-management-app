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
        <v-btn
          v-for="page in pages"
          :key="page"
          text
          :href="page.uri"
          class="mx-0 px-0"
          :title="page.uri"
        >
          <v-icon>{{page.icon}}</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">{{ page.title }}</span> -->
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
    return {
      pages: [
        { title: "寮紹介", uri: "/", icon: "mdi-home" },
        { title: "個人記録", uri: "/personalbook", icon: "mdi-account-circle" },
        { title: "寮会計", uri: "/dormbook", icon: "mdi-currency-jpy" },
        { title: "日程管理", uri: "/application", icon: "mdi-clock" },
        { title: "寮生名簿", uri: "/userlist", icon: "mdi-view-list" },
        { title: "寮文書", uri: "/archive", icon: "mdi-file-document" },
        { title: "ログアウト", uri: "/logout", icon: "mdi-lock-open" }
      ]
    };
  },
  mounted: function() {
    // console.log("URL:", this.avatarurl);
  }
};
</script>
<style scoped>
</style>
