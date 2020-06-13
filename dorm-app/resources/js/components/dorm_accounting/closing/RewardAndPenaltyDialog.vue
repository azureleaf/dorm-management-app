<template>
  <v-dialog v-model="isDialogOpen" persistent max-width="600px">
    <template v-slot:activator="{ on }">
      <v-btn color="error" depressed dark v-on="on" dense @click="initForms">
        <v-icon class="mr-1">mdi-square-edit-outline</v-icon>賞罰の追加
      </v-btn>
    </template>
    <v-card>
      <v-card-title>賞罰の追加</v-card-title>
      <v-card-text>
        <v-row justify="center">
          <v-radio-group v-model="isPayment" row>
            <v-radio
              v-for="itemCat in itemCats"
              :key="itemCat.en"
              :label="itemCat.text"
              :value="itemCat.isPayment"
            ></v-radio>
          </v-radio-group>
        </v-row>
        <v-row>
          <v-col cols="12" md="6">
            <v-select
              :items="filteredTitles"
              item-text="name_with_id"
              item-value="id"
              v-model="titleId"
              label="賞罰項目"
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
        <v-row>
          <v-col cols="12">
            <v-text-field
              label="特記事項"
              v-model="comment"
              required
            ></v-text-field>
          </v-col>
        </v-row>
        <v-row justify="center">
          <v-subheader>対象寮生</v-subheader>
        </v-row>
        <v-data-table
          :headers="userHeaders"
          :items="users"
          :items-per-page="users.length"
          show-select
          v-model="targetUsers"
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
        { isPayment: false, text: "報酬" },
        { isPayment: true, text: "罰金" }
      ],
      targetUsers: [],
      isPayment: true,
      itemCat: null,
      titleId: null,
      amount: null,
      comment: null,
      isDialogOpen: false,
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
  computed: {
    filteredTitles() {
      return this.titles.filter(item => {
        // Exclude id: 200 item (基本金請求)
        // because it shouldn't be selectable as a penalty
        return this.isPayment == item.is_payment && item.id != 200;
      });
    }
  },
  watch: {
    // Autofill the amount when the title is selected
    titleId: function(newId, oldId) {
      // Abort if the title inputted is null
      // When the title is cleared, watcher is also called
      // and its value will be set null
      if (!newId) return;

      const titleSelected = this.titles.filter(item => {
        return item.id == newId;
      });

      this.amount = titleSelected[0].default_amount;
    }
  },
  methods: {
    save() {
      this.$emit("setRewards", {
        targetUsers: this.targetUsers,
        title: this.titles.filter(item => {
          return item.id == this.titleId;
        })[0],
        amount: this.amount,
        comment: this.comment
      });
      this.isDialogOpen = false;
    },
    initForms() {
      this.targetUsers = [];
      this.isPayment = true;
      this.itemCat = null;
      this.titleId = null;
      this.amount = null;
      this.comment = null;
    }
  }
};
</script>
<style scoped></style>
