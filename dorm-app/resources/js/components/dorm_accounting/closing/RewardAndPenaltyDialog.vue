<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense>
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>賞罰の追加
      </v-btn>
    </template>
    <v-card>
      <v-card-title>賞罰の追加</v-card-title>
      <v-card-text>
        <v-row justify="center">
          <v-radio-group v-model="isReward" row>
            <v-radio
              v-for="itemCat in itemCats"
              :key="itemCat.en"
              :label="itemCat.text"
              :value="itemCat.isReward"
            ></v-radio>
          </v-radio-group>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              :items="titles"
              item-text="name"
              v-model="title"
              label="賞罰"
            ></v-select>
          </v-col>
          <v-col cols="12" md="6">
            <v-text-field
              label="金額"
              v-model="amount"
              type="number"
            ></v-text-field>
          </v-col>
        </v-row>
        <v-data-table
          :headers="userHeaders"
          :items="users"
          :items-per-page="users.length"
          show-select
          v-model="isTarget"
          hide-default-footer
        ></v-data-table>
      </v-card-text>
      <v-card-actions>
        <v-spacer></v-spacer>
        <v-btn color="blue darken-1" text @click="isDialogOpen = false"
          >Cancel</v-btn
        >
        <v-btn color="blue darken-1" text @click="save">Save</v-btn>
      </v-card-actions>
    </v-card>
  </v-dialog>
</template>

<script>
export default {
  props: ["users", "titles"],
  data: function() {
    return {
      itemCats: [
        { isReward: true, text: "報酬" },
        { isReward: false, text: "罰金" }
      ],
      isTarget: [],
      isReward: null,
      itemCat: null,
      title: null,
      amount: null,
      isDialogOpen: false,
      rewards: [],
      userHeaders: [
        {
          text: "寮生ID",
          sortable: false,
          value: "id"
        },
        {
          text: "氏名",
          sortable: false,
          value: "full_name"
        },
        {
          text: "部屋番号",
          sortable: false,
          value: "room.number"
        }
      ]
    };
  },
  methods: {
    save() {
      this.$emit("setRewards", this.rewards);
      this.isDialogOpen = false;
    }
  },
};
</script>
<style scoped></style>
