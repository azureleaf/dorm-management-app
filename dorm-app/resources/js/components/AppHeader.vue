<template>
  <v-container>
    <v-app-bar class="blue darken-4" dense dark app>
      <!-- <v-avatar>
        <v-img class="mx-2" :src="avatarurl" max-height="50" max-width="50" contain></v-img>
      </v-avatar> -->
      <v-toolbar-title class="ml-5 headline" style="font-family: 'Titillium Web' !important;">
        <v-icon large class="mr-1" color="orange">mdi-weather-snowy-heavy</v-icon>
        <span class="font-weight-black">Aobaryo</span>
        <span class="font-weight-light">Cloud</span>
      </v-toolbar-title>
      <v-spacer></v-spacer>
      <v-toolbar-items id="tb-items">
        <v-divider vertical></v-divider>
        <v-btn
          v-for="page in pages"
          :key="page.title"
          text
          :href="page.uri"
          :title="page.title"
          class="mx-0 px-0 d-none d-sm-flex"
        >
          <v-icon>{{page.icon}}</v-icon>
          <!-- <span class="d-none d-lg-flex d-xl-flex">{{ page.title }}</span> -->
        </v-btn>
        <v-divider vertical></v-divider>
      </v-toolbar-items>
      <v-menu v-model="isNavOpen" :offsetY="true">
        <template v-slot:activator="{ on }">
          <v-app-bar-nav-icon v-on="on" class="d-flex d-sm-none"></v-app-bar-nav-icon>
        </template>
        <v-list>
          <v-list-item v-for="page in pages" :key="page.title" :href="page.uri">
            <v-list-item-icon class="mr-3">
              <v-icon v-text="page.icon"></v-icon>
            </v-list-item-icon>
            <v-list-item-title>{{ page.title }}</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
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
        { title: "寮生一覧", uri: "/userlist", icon: "mdi-account-group" },
        { title: "寮文書", uri: "/archive", icon: "mdi-file-document" },
        { title: "ログアウト", uri: "/logout", icon: "mdi-lock-open" }
      ],
      isNavOpen: false
    };
  },
  mounted: function() {
    // console.log("URL:", this.avatarurl);
  }
};
</script>
<style scoped>
</style>
