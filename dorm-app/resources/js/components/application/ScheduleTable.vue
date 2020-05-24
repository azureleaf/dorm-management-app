<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>行事申請</v-card-title>
        <v-card-subtitle>「当番実施報告」「当番交代報告」「寮生大会委任状」「クリーンデー欠席届」を出すには、下のカレンダーから該当箇所をクリックしてください。</v-card-subtitle>
        <v-card-text>
          <v-row class="pb-5 mb-2">
            <v-col>
              <v-btn color="error" depressed absolute right>
                <v-icon class="mr-1">mdi-security</v-icon>寮行事日程編集
              </v-btn>
            </v-col>
          </v-row>
          <v-row>
            <v-col cols="12" md="4">
              <v-select :items="formTypes" v-model="formTypeSelected" label="表示する日程" outlined></v-select>
            </v-col>
          </v-row>
          <v-sheet tile height="54" color="grey lighten-3" class="d-flex">
            <v-btn icon class="ma-2" @click="$refs.calendar.prev()">
              <v-icon>mdi-chevron-left</v-icon>
            </v-btn>
            <v-spacer></v-spacer>
            <v-btn icon class="ma-2" @click="$refs.calendar.next()">
              <v-icon>mdi-chevron-right</v-icon>
            </v-btn>
          </v-sheet>
          <v-sheet height="600">
            <v-calendar
              ref="calendar"
              v-model="value"
              :weekdays="[0, 1, 2, 3, 4, 5, 6]"
              type="month"
              :events="events"
              event-overlap-mode="stack"
              :event-color="getEventColor"
              :event-overlap-threshold="30"
            ></v-calendar>
          </v-sheet>
          <v-btn @click="logs">A</v-btn>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      formTypeSelected: "寮行事",
      formTypes: [
        "寮行事",
        "風呂掃除",
        "脱衣所掃除",
        "１ブロック掃除",
        "２ブロック掃除",
        "３ブロック掃除",
        "４ブロック掃除",
        "５ブロック掃除",
        "６ブロック掃除"
      ],
      value: "",
      events: [
        {
          name: "寮生大会",
          start: "2020-05-20",
          end: "2020-05-20",
          color: "red"
        },
        {
          name: "201 田中",
          start: "2020-05-18",
          end: "2020-05-24",
          color: "green"
        }
      ]
    };
  },
  methods: {
    logs() {
      console.log(this.value);
    },
    getEventColor(event) {
      return event.color;
    },
    rnd(a, b) {
      return Math.floor((b - a + 1) * Math.random()) + a;
    },
    formatDate(a, withTime) {
      return withTime
        ? `${a.getFullYear()}-${a.getMonth() +
            1}-${a.getDate()} ${a.getHours()}:${a.getMinutes()}`
        : `${a.getFullYear()}-${a.getMonth() + 1}-${a.getDate()}`;
    }
  },
  mounted: async function() {
    const res = await axios.get("./billings");
    this.billItems = res.data;
  }
};
</script>
<style scoped>
</style>
