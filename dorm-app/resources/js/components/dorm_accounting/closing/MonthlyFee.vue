<template>
  <v-card outlined class="my-5">
    <v-card-title>
      基本金
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
        <template v-slot:item.edit="{}">
          <monthly-fee-dialog
            @setTotalAmount="setTotalAmount"
          ></monthly-fee-dialog>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  props: [
    "personsprop" // number of persons calculated in deducation table component
  ],
  data: function() {
    return {
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
    calcFee(newTotalAmount) {
      const totalAmount = newTotalAmount ? newTotalAmount : 0; // When the arg is empty, assign 0
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
    setTotalAmount(newTotalAmount) {
      const newFee = this.calcFee(newTotalAmount);

      // Update UI
      // Note that to trigger the UI update with "data:" property array,
      // you need to use certail methods such as .splice(), .push()
      // Refer to the Vue.js doc for this
      this.fees.splice(0, this.fees.length, newFee);

      // Urge the parent component to update the sessionStorage
      this.$emit("updateSS", { feeAmount: this.fees[0].feeAmount });

      this.isDialogOpen = false;
    }
  },
  mounted() {
    const feeCalculated = this.calcFee(0);
    this.fees.push(feeCalculated);
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}
</style>
