<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>寮生大会議事録</v-card-title>
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
          title: "2020年5月期寮生大会議事録",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "2020年4月期寮生大会議事録",
          last_author: "",
          updated_at: "",
          size: "",
        },
        {
          title: "2020年2月期寮生大会議事録",
          last_author: "",
          updated_at: "",
          size: "",
        },
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
