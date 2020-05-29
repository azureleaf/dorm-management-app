<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>職種一覧</v-card-title>
        <v-card-text>
          <!-- <role-title-table-edit-dialog :titles="this.titles" @reloadTitles="loadTitles"></role-title-table-edit-dialog> -->
          <v-data-table
            :headers="titleHeaders"
            :items="titles"
            :items-per-page="20"
            hide-default-footer
          ></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      titles: [],
      titleHeaders: [
        {
          text: "職種ID",
          sortable: false,
          value: "id"
        },
        {
          text: "職種",
          sortable: false,
          value: "name"
        },
        {
          text: "報酬額の既定値",
          sortable: false,
          value: "reward"
        },
        {
          text: "現職者名",
          sortable: false,
          value: "user_name"
        },
      ]
    };
  },
  methods: {
    async loadTitles() {
      const res = await axios.get("./roletitles");
      this.titles = res.data;

      // Append the new column for readable reward info
      this.titles.forEach(title => {
        title["reward"] = "寮費の" + title.default_reward_pct + "％";
      });
    }
  },
  mounted: async function() {
    this.loadTitles();
  }
};
</script>
<style scoped>
table {
  border-collapse: collapse;
}

table,
th,
td {
  border: 1px solid black;
}
</style>
