<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>文書</v-card-title>
        <v-card-text>
          <v-data-table :headers="manualsHeaders" :items="manuals" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      manuals: [
        {
          title: "委員長引継書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "副委員長引継書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "総務引継書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "会計委員引継書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "風呂掃除手順書",
          last_author: "",
          updated_at: "",
          category: "manual",
          size: "",
        },
        {
          title: "議長手順書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "補食場清掃手順書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "情報システム操作手順書",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "情報システム管理者要領",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "寮則",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "新入寮生オリエンテーション資料",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "寮生大会議事録",
          last_author: "",
          updated_at: "",
          size: "",
        },
      ],
      manualsHeaders: [
        {
          text: "題名",
          sortable: true,
          value: "title"
        },
        {
          text: "分類",
          sortable: true,
          value: "cat"
        },
        {
          text: "更新日時",
          sortable: true,
          value: "updated_at"
        },
         {
          text: "最終更新者",
          sortable: true,
          value: "last_author"
        },
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
