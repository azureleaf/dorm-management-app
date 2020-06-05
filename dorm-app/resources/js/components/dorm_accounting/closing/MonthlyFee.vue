<template>
  <v-card outlined class="my-5">
    <v-card-title>
      基本金
      <v-spacer></v-spacer>

      <v-dialog v-model="isDialogOpen" persistent max-width="600px">
        <template v-slot:activator="{ on }">
          <v-btn color="error" depressed dark v-on="on" dense>
            <v-icon class="mr-1">mdi-square-edit-outline</v-icon>徴収総額の設定
          </v-btn>
        </template>
        <v-card>
          <v-card-title>徴収総額の設定</v-card-title>
          <v-card-text>
            <v-row>
              <v-col>
                <v-text-field
                  label="徴収総額"
                  v-model="totalAmountInput"
                  type="number"
                ></v-text-field>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="isDialogOpen = false"
              >Cancel</v-btn
            >
            <v-btn color="blue darken-1" text @click="updateTotalAmount"
              >Save</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-card-title>
    <v-card-text>
      <v-data-table
        :headers="feeHeaders"
        :items="fees"
        :items-per-page="1"
        hide-default-footer
      >
        <template v-slot:item.totalAmount="{ item }">
          <span v-if="!item.totalAmount">-</span>
          <span v-else> {{ formatCurrency(item.totalAmount) }} </span>
        </template>
        <template v-slot:item.feeAmount="{ item }">
          <v-chip
            color="primary"
            outlined
            large
            label
            class="my-1 font-weight-bold"
          >
            {{ formatCurrency(item.feeAmount) }}
          </v-chip>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: ["personsprop", "totalamountprop", "feeid"],
  data: function() {
    return {
      totalAmountInput: "",
      isTotalAmountUpdated: false,
      isDialogOpen: false,
      feeHeaders: [
        {
          text: "徴収総額",
          sortable: false,
          value: "totalAmount"
        },
        {
          text: "換算負担人数",
          sortable: false,
          value: "personsAfterDeduction"
        },
        {
          text: "除算結果",
          sortable: false,
          value: "quotient"
        },
        {
          text: "基本金（切り上げ）",
          sortable: false,
          value: "feeAmount"
        }
      ]
    };
  },
  methods: {
    async updateTotalAmount() {
      // Update the v-data-table
      this.isTotalAmountUpdated = true;

      // Update the monthly fee table in the DB
      await axios.put(`/monthly-fees/${this.feeid}`, {
        total_amount: this.fees[0].totalAmount,
        fee_amount: this.fees[0].feeAmount
      });

      this.isDialogOpen = false;
    }
  },
  computed: {
    fees: {
      // Show temporary empty object when the props aren't loaded
      get() {
        if (
          !this.personsprop ||
          this.personsprop.length == 0 ||
          !this.totalamountprop
        ) {
          return [
            {
              totalAmount: "",
              personsAfterDeduction: "",
              quotient: "",
              feeAmount: ""
            }
          ];
        } else {
          // If the new amount is input by dialog, use the value
          // If not, use the props passed by the parent
          const totalAmount = this.isTotalAmountUpdated
            ? this.totalAmountInput
            : this.totalamountprop;
          const quotient = (totalAmount / this.personsprop).toFixed(2);
          const feeAmount = Math.ceil(quotient);
          return [
            {
              totalAmount,
              personsAfterDeduction: this.personsprop,
              quotient,
              feeAmount
            }
          ];
        }
      }
    }
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
