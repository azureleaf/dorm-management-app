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
            <v-btn color="blue darken-1" text @click="handleTotalAmountUpdate"
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
  // Both props aren't "undefined" by the v-if restriction in the parent component
  props: [
    "personsprop", // number of persons calculated in deducation table component
    "feedb" // fee of the latest month stored in the database
  ],
  data: function() {
    return {
      totalAmountInput: null, // New amount inputted in the dialog form
      isDialogOpen: false,
      fees: [], // used for v-data-table content
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
    // Calculate the fees based on the props passed by the parent
    calcFee() {
      // Items of the fee object
      const totalAmount = this.totalAmountInput
        ? this.totalAmountInput
        : this.feedb.total_amount;
      const personsBeforeDeduction = this.personsprop.beforeDeduction;
      const personsAfterDeduction = this.personsprop.afterDeduction;
      const quotient = (totalAmount / this.personsprop.afterDeduction).toFixed(
        2
      );
      const feeAmount = Math.ceil(quotient);

      return {
        totalAmount,
        personsBeforeDeduction,
        personsAfterDeduction,
        quotient,
        feeAmount
      };
    },
    // Update the monthly fee table in the DB
    async handleTotalAmountUpdate() {
      const newFee = this.calcFee();

      // Update UI
      // Note that to trigger the UI update with "data:" property array,
      // you need to use certail methods such as .splice(), .push()
      // Refer to the Vue.js doc for this
      this.fees.splice(0, this.fees.length, newFee);

      // Update DB
      this.updateDB(newFee);

      // Close the dialog box
      this.isDialogOpen = false;
    },
    async updateDB(newFee) {
      await axios.put(`/monthly-fees/${this.feedb.id}`, {
        total_amount: newFee.totalAmount,
        persons: newFee.personsBeforeDeduction,
        persons_after_deduction: newFee.personsAfterDeduction,
        fee_amount: newFee.feeAmount
      });
    },
    /**
     *  Check if the calculated fee items in this component is
     *    identical with those in the DB.
     *  Calc result may be diverged because number of users can be modified
     *    after the last writing to the DB.
     */
    async keepFeeIntegrity(feeStored, feeCalculated) {
      // If there's at least a discrepancy between 2 arg fees,
      // update the DB with the newly calculate fee
      if (
        feeStored.total_amount != feeCalculated.totalAmount ||
        feeStored.persons != feeCalculated.personsBeforeDeduction ||
        feeStored.persons_after_deduction !=
          feeCalculated.personsAfterDeduction ||
        feeStored.fee_amount != feeCalculated.feeAmount
      )
        console.log(
          "Monthly fee record in the DB is outdated; going to update."
        );
      this.updateDB(feeCalculated);

      this.fees.push(feeCalculated);
    }
  },
  async mounted() {
    const feeCalculated = this.calcFee();

    this.keepFeeIntegrity(this.feedb, feeCalculated);
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
