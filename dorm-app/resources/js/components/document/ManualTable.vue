<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>定型文書</v-card-title>
        <v-card-text>
          <v-data-table :headers="docHeaders" :items="docs" :items-per-page="20"></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      docs: [
        {
          title: "寮則",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "委員長引継書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "副委員長引継書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "総務引継書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "会計委員引継書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "風呂掃除手順書",
          last_author: "",
          updated_at: "",
          category: "manual",
          size: ""
        },
        {
          title: "議長手順書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "補食場清掃手順書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "トイレ清掃手順書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "情報システム管理手順書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "債務承認弁済契約書",
          last_author: "",
          updated_at: "",
          size: ""
        },
        {
          title: "新入寮生オリエンテーション資料",
          last_author: "",
          updated_at: "",
          size: ""
        }
      ],
      docHeaders: [
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
          text: "編集権限",
          sortable: true,
          value: "auth"
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
        }
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
