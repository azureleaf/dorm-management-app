<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>職種一覧</span>
          <v-spacer></v-spacer>
          <v-btn color="error" depressed absolute right>
            <v-icon class="mr-1">mdi-plus-circle</v-icon>職種の追加
          </v-btn>
        </v-card-title>
        <v-card-text>
          <!-- <role-title-table-edit-dialog :titles="this.titles" @reloadTitles="loadTitles"></role-title-table-edit-dialog> -->
          <v-data-table
            :headers="titleHeaders"
            :items="titles"
            :items-per-page="titles.length"
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
          value: "incumbents"
        }
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

      // Let the v-data-table detect the data update
      this.titles = this.titles.splice(0, this.titles.length, ...this.titles);
    },
    async loadRoleHistories() {
      // Retrieve all the role histories
      const res = await axios.get("./role-histories");
      let hxs = res.data;

      // Filter out the former / future role histories, keep current ones only
      return hxs.filter(hx => {
        const now = new Date();
        if (now - new Date(hx.start_at) >= 0 && new Date(hx.end_at) - now >= 0)
          return 1;
        else return 0;
      });
    }
  },
  mounted: async function() {
    await this.loadTitles();
    const incumbents = await this.loadRoleHistories();

    // Loop for all the role titles
    this.titles.forEach(title => {
      let incumbentsStr = "";

      // Loop for all the role histories
      // Notice that multiple people may be assigned for a role title
      incumbents.forEach(incumbent => {
        if (title.id == incumbent.role_title_id) {
          incumbentsStr += `${incumbent.user.full_name}　`;
        }
      });

      // Add new value to the table
      title["incumbents"] = incumbentsStr;
    });

    // Just copying the array to self
    // Without this, v-data-table doesn't detect the data update of the array
    // Seemingly this is a sort of bug of the Vuetify / Vue
    this.titles = this.titles.splice(0, this.titles.length, ...this.titles);
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
