<template>
  <v-card outlined class="my-5">
    <v-card-title>
      <span>負担人数</span>
    </v-card-title>
    <v-card-text>
      <!-- <v-card class="pa-3 formula" flat outlined>
        <v-chip outlined label large color="green darken-2">一般会計支出： 200000</v-chip>
        <span class="display-1">÷</span>
        <v-chip outlined label large color="green darken-2">負担人数： 45.2</v-chip>
        <span class="display-1">=</span>
        <v-chip outlined label large color="red">寮費（端数切り上げ）： 12345</v-chip>
      </v-card>-->
      <v-data-table
        :headers="burdenHeaders"
        :items="burdens"
        :items-per-page="burdens.length"
        hide-default-footer
      >
        <template v-slot:item.persons="{ item }">
          <span :class="{ emphasis: item.isTotalRow }">{{ item.persons }}</span>
        </template>
        <template v-slot:item.persons_after_deduction="{ item }">
          <span :class="{ emphasis: item.isTotalRow }">{{
            item.persons_after_deduction
          }}</span>
        </template>
      </v-data-table>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  data: function() {
    return {
      burdens: [],
      payerTypes: [
        {
          type: "委員長",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "副委員長",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "総務",
          burden_rate: "0.5",
          persons: "1",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "会計委員",
          burden_rate: "0.25",
          persons: "2",
          persons_deducted: "0.5",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "会計委員（報酬額変更）",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "2020-06",
          end_at: "2020-09",
          comment: ""
        },
        {
          type: "臨時委員",
          burden_rate: "0",
          persons: "1",
          persons_deducted: "0",
          start_at: "2020-06",
          end_at: "2020-09",
          comment: "水不足の対処担当"
        },
        {
          type: "一般寮生",
          burden_rate: "1",
          persons: "54",
          persons_deducted: "50",
          start_at: "",
          end_at: "",
          comment: ""
        },
        {
          type: "合計",
          burden_rate: "",
          persons: "60",
          persons_deducted: "",
          start_at: "",
          end_at: "",
          comment: ""
        }
      ],
      burdenHeaders: [
        {
          text: "職名",
          sortable: false,
          value: "role_name"
        },
        // {
        //   text: "開始月",
        //   sortable: false,
        //   value: "start_at"
        // },
        // {
        //   text: "終了月",
        //   sortable: false,
        //   value: "end_at"
        // },
        {
          text: "負担率",
          sortable: false,
          value: "burden_rate"
        },
        {
          text: "実人数",
          sortable: false,
          value: "persons"
        },
        {
          text: "換算負担人数",
          sortable: false,
          value: "persons_after_deduction"
        }
      ]
    };
  },
  computed: {
    periodSelected() {
      return this.periods[this.periods.length - 1];
    }
  },
  methods: {
    async loadIncumbents() {
      const res = await axios.get("/role-histories/incumbent");
      return res.data;
    },
    async loadRoleTitles() {
      const res = await axios.get("/role-titles/");
      return res.data;
    },
    async countCurrentUsers() {
      const res = await axios.get("/users");
      const count = res.data.reduce((acc, curr) => {
        if (curr.move_out_at == null) return ++acc;
        else return acc;
      }, 0);
      return count;
    },
    /**
     * Set burdens[] array which is shown in v-data-table
     */
    async setBurdens() {
      const incumbents = await this.loadIncumbents();
      const roleTitles = await this.loadRoleTitles();
      const currentUsersCount = await this.countCurrentUsers();

      // Append committee members to the table
      roleTitles.forEach(roleTitle => {
        let personCount = 0;
        incumbents.forEach(incumbent => {
          if (roleTitle.id == incumbent.role_title_id) ++personCount;
        });
        const burden_rate = 1 - roleTitle.default_reward_pct / 100;
        this.burdens.push({
          role_name: roleTitle.name,
          burden_rate: burden_rate,
          persons: personCount,
          persons_after_deduction: personCount * burden_rate
        });
      });

      // Append normal boarders to the table
      const normalUsersCount = currentUsersCount - incumbents.length;
      this.burdens.push({
        role_name: "一般寮生",
        burden_rate: 1,
        persons: normalUsersCount,
        persons_after_deduction: normalUsersCount * 1
      });

      // Append total to the table
      const personsAfterDeductionTotal = this.burdens.reduce((acc, curr) => {
        return acc + curr.persons_after_deduction;
      }, 0);
      this.burdens.push({
        role_name: "合計",
        burden_rate: "",
        persons: currentUsersCount,
        persons_after_deduction: personsAfterDeductionTotal,
        isTotalRow: true
      });
    }
  },
  mounted: async function() {
    this.setBurdens();
  }
};
</script>
<style scoped>
div.formula > span {
  vertical-align: middle;
}

.emphasis {
  font-weight: bold;
  color: blue;
}
</style>
