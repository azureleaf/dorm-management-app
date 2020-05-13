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
          <p>仙台にある青葉大学の男子寮・青葉寮の公式ウェブサイトです。入寮をお考えの皆さまに私たちの寮をご紹介いたします。</p>
          <p>
            在寮生には青葉寮運営電子化基盤（Aoba Cloud）のサービスを提供します。利用するには
            <a href="./login">ログイン</a>してください。
          </p>
        </v-card-text>
      </v-card>
      <v-card elevation="10" class="card-section">
        <v-card-title>基本情報</v-card-title>
        <v-card-text>
          <v-data-table
            :headers="contactHeaders"
            :items="contacts"
            :items-per-page="contacts.length"
            hide-default-header
            hide-default-footer
          ></v-data-table>
        </v-card-text>
      </v-card>
      <v-card elevation="10" class="card-section">
        <v-card-title>設備</v-card-title>
        <v-card-text>
           <v-data-table
            :headers="facilityHeaders"
            :items="facilities"
            :items-per-page="facilities.length"
            hide-default-header
            hide-default-footer
          ></v-data-table>
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
          <v-data-table
            :headers="monthHeaders"
            :items="months"
            :items-per-page="12"
            hide-default-footer
          ></v-data-table>
        </v-card-text>
      </v-card>
    </v-container>
  </v-content>
</template>

<script>
export default {
  data: function() {
    return {
      contacts: [
        { title: "連絡先", desc: "hoge@gmail.com<br>返信まで数日かかる場合がありますが、ご了承ください。" },
        { title: "所在地", desc: "仙台市一番町<br>当寮と同じ住所に寮が複数ありますので、郵便物には寮名・部屋番号まで必ず書いてください。" },
        { title: "定員", desc: "100名" },
        { title: "入寮資格", desc: "本学の大学生・大学院生" },
        {
          title: "入寮申込方法",
          desc:
            "本学の<a href=''>教務学生支援課生活支援係</a>（TEL: 022-123-4567）に直接ご応募ください。"
        }
      ],
      contactHeaders: [
        {
          text: "項目",
          sortable: false,
          value: "title"
        },
        {
          text: "内容",
          sortable: false,
          value: "desc"
        }
      ],
            facilities: [
        { title: "居室", desc: "全室一人部屋（5.5畳、FF式石油ヒーター、ベランダ）" },
        { title: "共用自炊設備", desc: "ガスコンロ、冷蔵庫、電子レンジ、給湯器" },
        { title: "共用生活設備", desc: "風呂、トイレ、洗面所、集会室、洗濯機、乾燥機、自動販売機、駐車場、駐輪場。AED設置済" },
        { title: "インターネット", desc: "有線/Wifiともに共用回線に接続可能。より高速な接続環境を希望する方は回線を個人契約してください（ FLET'S光マンションタイプ導入工事済）。" },
        { title: "周辺施設", desc: "銀行・郵便局・コンビニ・飲食店・交番・医院などが徒歩5分圏内です。バス停も近く、仙台駅・八木山動物公園駅・片平キャンパスまで直通バスあり。" },
      ],
      facilityHeaders: [
        {
          text: "項目",
          sortable: false,
          value: "title"
        },
        {
          text: "内容",
          sortable: false,
          value: "desc"
        }
      ],
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
              title: "生活費が非常に安い",
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
                "私達の寮は伝統的に他寮よりも静かで平穏な気風です。飲酒の強制も一切ありません。"
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
            "共同生活では、寮生同士の役割分担が不可欠です。",
          sectionItems: [
            {
              title: "寮費を納める",
              desc: "寮費納入は、寮生の一番大切な義務です。"
            },
            {
              title: "寮内の会議に出席する",
              desc:
                "長期休暇の期間を除き毎月１回の定例会議を行っています。ただし正当な理由がある場合は、欠席もできます。ここでは寮生活における困り事の相談やルール決めを行います。"
            },
            {
              title: "委員会の仕事をおこなう",
              desc:
                "当寮は委員会(委員長、副委員長、総務、会計)が寮の運営をしており、年３期制です。新入寮生は委員会の仕事を一期受け持ち、文書作成や大学との連絡などを担います。委員会の仕事を行っている間は寮費が減免されます。"
            },
            {
              title: "掃除当番をこなす",
              desc:
                "風呂やトイレ、炊事場などを掃除します。 掃除の担当は寮生全員に均等に割り振られ、頻度は月に１回ほどです。"
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
