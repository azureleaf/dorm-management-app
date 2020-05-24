<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>役職一覧</v-card-title>
        <v-card-text>
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
          text: "職名ID",
          sortable: false,
          value: "id"
        },
        {
          text: "職名",
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
        {
          text: "編集権限",
          sortable: false,
          value: "auth"
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./roletitles");
    this.titles = res.data;

    // Append the new column for readable reward info
    this.titles.forEach(title => {
        title["reward"] = "寮費の" + title.default_reward_pct + "％";
    });
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
