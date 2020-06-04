<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          役職記録
          <v-spacer></v-spacer>
          <role-history-dialog
            :isCreation="true"
            :currHistory="undefined"
            @retrieveAgain="retrieve"
          ></role-history-dialog>
        </v-card-title>
        <v-card-text>
          <v-data-table :headers="hxHeaders" :items="hxs" :items-per-page="20">
            <template v-slot:item.reward_pct="{ item }"
              >{{ item.reward_pct }}%</template
            >
            <template v-slot:item.edit="{ item }">
              <role-history-dialog
                :isCreation="false"
                :currHistory="item"
                @retrieveAgain="retrieve"
              ></role-history-dialog>
            </template>
            <template v-slot:item.readable_term="{ item }">
              {{ item.fiscal_year }}年度{{ item.term }}期
            </template>
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
          text: "寮生ID",
          sortable: true,
          value: "user.id"
        },
        {
          text: "氏名",
          sortable: true,
          value: "user.full_name"
        },
        {
          text: "職種",
          sortable: true,
          value: "role_title.name"
        },
        {
          text: "委員会期",
          sortable: true,
          value: "readable_term"
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
          text: "寮費免除率",
          sortable: false,
          value: "reward_pct"
        },
        {
          text: "特記事項",
          sortable: false,
          value: "comment"
        },
        {
          text: "編集",
          sortable: false,
          value: "edit"
        }
      ]
    };
  },
  methods: {
    async retrieve() {
      const res = await axios.get("./role-histories");
      this.hxs = res.data;
    }
  },
  mounted: async function() {
    this.retrieve();
  }
};
</script>
<style scoped></style>
