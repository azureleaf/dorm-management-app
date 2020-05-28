<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>役職履歴</v-card-title>
        <v-card-text>
          <v-data-table :headers="hxHeaders" :items="hxs" :items-per-page="20">
            <template v-slot:item.reward_pct="{ item }">{{ item.reward_pct}}%</template>
            <template v-slot:item.name="{ item }">{{ item.user.full_name }} (#{{ item.user_id }})</template>
          </v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      hxs: [],
      hxHeaders: [
        {
          text: "役職履歴ID",
          sortable: true,
          value: "id"
        },
        {
          text: "氏名",
          sortable: true,
          value: "name"
        },
        {
          text: "職名",
          sortable: true,
          value: "role_title.name"
        },
        {
          text: "開始日",
          sortable: true,
          value: "start_at"
        },

        {
          text: "終了日",
          sortable: true,
          value: "end_at"
        },
        {
          text: "報酬率",
          sortable: false,
          value: "reward_pct"
        },
        {
          text: "特記事項",
          sortable: false,
          value: "comment"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./rolehx");
    this.hxs = res.data;
  }
};
</script>
<style scoped></style>
