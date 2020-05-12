<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>状態一覧</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="4">
              <v-card color="indigo darken-4" height="100%" dark>
                <v-card-title>引落状況</v-card-title>
                <v-card-text>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>
                        <v-row align="center">
                          <v-col>次回の引落予定：</v-col>
                          <v-col>
                            <v-chip label outlined large color="white" class="px-4">
                              <v-icon>mdi-currency-jpy</v-icon>
                              <span class="headline ml-1">12345</span>
                            </v-chip>
                          </v-col>
                        </v-row>
                      </v-list-item-title>
                      <v-list-item-subtitle>2020-03-01</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>
                        <v-row align="center">
                          <v-col>前回の引落結果：</v-col>
                          <v-col>
                            <v-icon>mdi-check-circle</v-icon>
                            <span class="ml-1">成功</span>
                          </v-col>
                        </v-row>
                      </v-list-item-title>
                      <v-list-item-subtitle>2020-02-10</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card color="red darken-4" height="100%" dark>
                <v-card-title>当番予定</v-card-title>
                <v-card-text>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>２F補食室ブロック清掃</v-list-item-title>
                      <v-list-item-subtitle>2020-03-01 - 2020-03-07</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>脱衣所清掃</v-list-item-title>
                      <v-list-item-subtitle>2020-03-25</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card color="teal darken-4" height="100%" dark>
                <v-card-title>賞罰記録</v-card-title>
                <v-card-text>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>風呂掃除放棄罰金 +4000</v-list-item-title>
                      <v-list-item-subtitle>2020-02分</v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-card-text>
              </v-card>
            </v-col>
          </v-row>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      users: "",
      userHeaders: [
        {
          text: "ID",
          sortable: true,
          value: "id"
        },
        {
          text: "名前",
          sortable: true,
          value: "name"
        },
        {
          text: "メールアドレス",
          sortable: false,
          value: "email"
        },
        {
          text: "部屋番号",
          sortable: true,
          value: ""
        },
        {
          text: "役職",
          sortable: true,
          value: ""
        }
      ]
    };
  },
  mounted: async function() {
    // You don't have to require axios; it's already loaded
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped>
</style>
