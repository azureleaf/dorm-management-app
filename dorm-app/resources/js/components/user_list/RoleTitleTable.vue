<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>
          <span>職種一覧</span>
          <!-- <v-spacer></v-spacer>
          <v-btn color="error" depressed absolute right>
            <v-icon class="mr-1">mdi-plus-circle</v-icon>職種の追加
          </v-btn> -->
        </v-card-title>
        <v-card-text>
          <!-- <role-title-table-edit-dialog :titles="this.titles" @reloadTitles="loadTitles"></role-title-table-edit-dialog> -->
          <v-data-table
            :headers="titleHeaders"
            :items="titles"
            :items-per-page="titles.length"
            hide-default-footer
          >
            <template v-slot:item.edit="{ item }">
              <role-title-table-edit-dialog
                :titleDetails="item"
                @reloadTitles="loadTitles"
              ></role-title-table-edit-dialog>
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
          text: "既定の寮費免除率",
          sortable: false,
          value: "reward"
        },
        {
          text: "現任者",
          sortable: false,
          value: "incumbents"
        },
        {
          text: "既定の寮費免除率を編集",
          sortable: false,
          value: "edit"
        }
      ]
    };
  },
  methods: {
    async loadTitles() {
      const res = await axios.get("./role-titles");
      this.titles = res.data;

      // Append the new column for readable reward info
      this.titles.forEach(title => {
        title["reward"] = "寮費の" + title.default_reward_pct + "％";
      });

      // Let the v-data-table detect the data update
      this.titles = this.titles.splice(0, this.titles.length, ...this.titles);
    },
    async loadIncumbents() {
      // Retrieve role histories of incumbent committee members
      const res = await axios.post("./role-histories/incumbents", {
        date: this.formatDate(new Date()) // today in YYYY-MM-DD format
      });
      return res.data;
    }
  },
  mounted: async function() {
    await this.loadTitles();
    const incumbents = await this.loadIncumbents();

    // Append the new column of incumbents to titles table
    // Loop for all the role titles
    this.titles.forEach(title => {
      // Readable string of incumbents for this role title
      let incumbentsStr = "";

      // Loop for all the role histories
      // Notice that multiple people may be assigned to a single role title
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
    // According to Vue official doc, this is the default behavior for object reactivity
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
