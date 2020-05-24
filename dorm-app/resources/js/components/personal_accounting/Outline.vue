<template>
  <v-content>
    <v-container>
      <v-card elevation="10">
        <v-card-title>Dashboard</v-card-title>
        <v-card-text>
          <v-row>
            <v-col cols="12" md="4">
              <v-card height="100%" outlined>
                <v-toolbar flat class="white--text" color="red darken-4" dark dense>
                  <v-toolbar-title>
                    <v-icon class="vmid">mdi-clock</v-icon>
                    <span class="vmid">行事日程</span>
                  </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>２F補食室ブロック清掃</v-list-item-title>
                      <v-list-item-subtitle>2020-03-01 - 2020-03-07</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                      <v-btn fab small color="white">
                        <v-icon color="red darken-4">mdi-pen</v-icon>
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>寮生大会</v-list-item-title>
                      <v-list-item-subtitle>2020-03-20</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                      <v-btn fab small color="white">
                        <v-icon color="red darken-4">mdi-pen</v-icon>
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>脱衣所清掃</v-list-item-title>
                      <v-list-item-subtitle>2020-03-25</v-list-item-subtitle>
                    </v-list-item-content>
                    <v-list-item-action>
                      <v-btn fab small color="white">
                        <v-icon color="red darken-4">mdi-pen</v-icon>
                      </v-btn>
                    </v-list-item-action>
                  </v-list-item>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card height="100%" outlined>
                <v-toolbar flat class="white--text" color="indigo darken-4" dark dense>
                  <v-toolbar-title>
                    <v-icon class="vmid">mdi-currency-jpy</v-icon>
                    <span class="vmid">引落状況</span>
                  </v-toolbar-title>
                </v-toolbar>
                <v-card-text>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>
                        <v-row align="center">
                          <v-col>次回の引落予定：</v-col>
                          <v-col>
                            <v-chip label outlined large color="indigo darken-4" class="px-4">
                              <v-icon>mdi-currency-jpy</v-icon>
                              <span class="headline ml-1">12345</span>
                            </v-chip>
                          </v-col>
                        </v-row>
                      </v-list-item-title>
                      <v-list-item-subtitle>
                        2020-03-01
                        <br />2020年2月分 + 2020年3月分
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                  <v-list-item two-line>
                    <v-list-item-content>
                      <v-list-item-title>
                        <v-row align="center">
                          <v-col>前回の引落結果：</v-col>
                          <v-col>
                            <div v-if="isDebitSuccess" class="px-4">
                              <v-icon class="vmid" color="green">mdi-check-circle</v-icon>
                              <span class="vmid">成功</span>
                            </div>
                            <div v-else class="px-4">
                              <v-icon class="vmid">mdi-close-circle</v-icon>
                              <span class="vmid">失敗</span>
                            </div>
                          </v-col>
                        </v-row>
                      </v-list-item-title>
                      <v-list-item-subtitle>
                        2020-02-10
                        <br />2020年1月分
                      </v-list-item-subtitle>
                    </v-list-item-content>
                  </v-list-item>
                </v-card-text>
              </v-card>
            </v-col>
            <v-col cols="12" md="4">
              <v-card height="100%" outlined>
               <v-toolbar flat class="white--text" color="green darken-4" dark dense>
                  <v-toolbar-title>
                    <v-icon class="vmid">mdi-medal</v-icon>
                    <span class="vmid">賞罰記録</span>
                  </v-toolbar-title>
                </v-toolbar>
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
      isDebitSuccess: true,
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
.vmid {
  vertical-align: middle;
}
</style>
