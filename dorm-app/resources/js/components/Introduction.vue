<template>
  <v-content>
    <v-container>
      <v-card elevation="10" class="card-section">
        <v-img
          class="white--text align-end"
          height="200px"
          src="https://cdn.vuetifyjs.com/images/cards/house.jpg"
        ></v-img>
        <v-card-title class="font-weight-bold">青葉大学青葉寮公式サイトへようこそ！</v-card-title>
        <v-card-text>
          <p>仙台にある青葉大学の男子寮・青葉寮の公式ウェブサイトです。入寮をお考えの皆さまに当寮をご紹介いたします。</p>
          <p>
            在寮生には青葉寮運営電子化基盤（Aoba Cloud）のサービスを提供します。利用するには
            <a href="./login">ログイン</a>してください。
          </p>
        </v-card-text>
      </v-card>
      <v-card elevation="10" class="card-section">
        <v-card-title>基本情報</v-card-title>
        <v-card-text>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
      <v-card elevation="10" class="card-section">
        <v-card-title>設備</v-card-title>
        <v-card-text>
          <p>最近の罰金</p>
        </v-card-text>
      </v-card>
      <v-card
        v-for="(section, sectionIndex) in sections"
        :key="sectionIndex"
        elevation="10"
        class="card-section"
      >
        <v-card-title>{{section.sectionTitle}}</v-card-title>
        <v-card-subtitle>{{section.sectionSubtitle}}</v-card-subtitle>
        <v-card-text>
          <v-card v-for="(sectionItem, index) in section.sectionItems" :key="index" outlined tile>
            <v-card-title>{{sectionItem.title}}</v-card-title>
            <v-card-text>{{sectionItem.desc}}</v-card-text>
          </v-card>
        </v-card-text>
      </v-card>
      <v-card elevation="10" class="card-section">
        <v-card-title>年間行事</v-card-title>
        <v-card-text>
          <v-data-table :headers="monthHeaders" :items="months" :items-per-page="12" hide-default-footer></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      months: [
        {
          month: 1,
          term: "２期",
          events: "（新年会）"
        },
        {
          month: 2,
          term: "３期",
          events: "風呂掃除担当月"
        },
          {
          month: 3,
          term: "３期",
          events: "追い出しコンパ・寮生大会休み"
        },
          {
          month: 4,
          term: "３期",
          events: "新歓コンパ・新入寮生オリエンテーション・灯油供給終了"
        },
          {
          month: 5,
          term: "３期",
          events: "風呂掃除担当月"
        },
          {
          month: 6,
          term: "１期",
          events: ""
        },
          {
          month: 7,
          term: "１期",
          events: ""
        },
          {
          month: 8,
          term: "１期",
          events: "風呂掃除・寮生大会休み"
        },
          {
          month: 9,
          term: "１期",
          events: ""
        },
          {
          month: 10,
          term: "２期",
          events: "灯油供給開始"
        },
          {
          month: 11,
          term: "２期",
          events: "風呂掃除担当月"
        },
          {
          month: 12,
          term: "２期",
          events: "忘年会"
        }
      ],
      monthHeaders: [
        {
          text: "月",
          sortable: false,
          value: "month"
        },
        {
          text: "学年暦",
          sortable: false,
          value: "semester"
        },
        {
          text: "委員会期",
          sortable: false,
          value: "term"
        },
        {
          text: "行事",
          sortable: false,
          value: "events"
        }
      ],
      sections: [
        {
          sectionTitle: "特長",
          sectionSubtitle: "寮生活には数々のメリットがあります。",
          sectionItems: [
            {
              title: "寮費が非常に安い",
              desc:
                "寄宿料（家賃）・水光熱費・共益費などを含めても、一ヶ月の寮費は1万円（夏季）から1.5万円（冬季）程度。通常のアパート暮らしはもちろん、ユニバーシティハウスと比べても生活費は格段に安いです。学資負担や長時間アルバイトによる学業への悪影響を大幅に軽減できます。"
            },
            {
              title: "寮業務が少ない",
              desc:
                "寮運営のための最低限の義務はありますが仕事量は他寮より少なく、留守番など面倒な日直当番制もありません。もちろん学生運動などありません。"
            },
            {
              title: "すべて一人部屋",
              desc: "自分だけの空間が守られます。"
            },
            {
              title: "在学中は継続して住める",
              desc:
                "学部・大学院の正規学生である限り居住できます。居住可能年数が原則２年のユニバーシティハウスと異なり、在学中に引っ越す必要がありません。"
            },
            {
              title: "落ち着いた雰囲気",
              desc:
                "当寮は伝統的に他寮よりも静かで平穏な気風です。飲酒の強制も一切ありません。"
            }
          ]
        },
        {
          sectionTitle: "よくある質問",
          sectionSubtitle: "頻繁に寄せられる疑問にお答えします。",
          sectionItems: [
            {
              title: "どうやって通学しているの？",
              desc: "あああ"
            },
            {
              title: "建物古くない？",
              desc: "あああ"
            },
            {
              title: "食事は？",
              desc: "寮運"
            },
            {
              title: "買い物は？",
              desc: "寮運"
            }
          ]
        },
        {
          sectionTitle: "寮生の仕事",
          sectionSubtitle:
            "共同生活では、寮生の皆さんの役割分担が不可欠になります。",
          sectionItems: [
            {
              title: "寮費を納める",
              desc: "寮費納入は、寮生の一番大切な義務です。"
            },
            {
              title: "寮内の会議に出席する",
              desc:
                "長期休暇の３月、８月以外は毎月１回の寮生大会を行っております。ただし正当な理由がある場合は、何回か欠席することもできます。ここでは寮生活に関する困り事の相談やルール決めを行います。"
            },
            {
              title: "委員会の仕事をおこなう",
              desc:
                "当寮は委員会(委員長、副委員長、総務、会計)が寮の運営をしており、年３期制です。新入寮生は委員会の仕事を一期分、受け持ちます。委員会の仕事を行っている間は寮費が減免されます。"
            },
            {
              title: "掃除当番を行う",
              desc:
                "風呂やトイレ、炊事場などを掃除します。 掃除の担当は寮生全員に均等に割り振られます。（月に１回程度）"
            }
          ]
        }
      ]
    };
  },
  mounted: async function() {
    const res = await axios.get("./users");
    this.users = res.data;
  }
};
</script>
<style scoped>
.card-section {
  margin-bottom: 30px;
}
</style>
