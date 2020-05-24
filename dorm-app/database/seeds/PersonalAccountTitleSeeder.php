<?php

use Illuminate\Database\Seeder;
use App\PersonalAccountTitle;

class PersonalAccountTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
            array(101, false, "寮費支払", "", null),
            array(102, false, "寮費修正返還", "寮費の徴収ミス修正などのための返還", null),
            array(103, false, "風呂掃除無許可欠席者代行報酬", "", 4000),
            array(104, false, "ブロック掃除無許可欠席者代行報酬", "", 2000),
            array(105, false, "クリーンデー参加者報酬", "欠席者の罰金合計を出席者で頭割り", null),
            array(106, false, "監査報酬", "", null),
            array(107, false, "議長報酬", "", 2000),
            array(199, false, "その他の減算", "", null),
            array(201, true, "寮費請求", "", null),
            array(202, true, "風呂掃除不履行罰金", "", 4000),
            array(203, true, "脱衣所掃除不履行罰金", "", 1000),
            array(204, true, "ブロック掃除不履行罰金", "", 2000),
            array(205, true, "寮費滞納罰金", "4ヶ月以上滞納し、かつ寮生大会で弁明が認められなかった場合", 10000),
            array(206, true, "ブロック長不履行罰金", "代わりを見つけずにブロック長を務めない場合の１ヶ月あたりの罰金", 100),
            array(207, true, "委員不履行罰金", "代わりを見つけずに委員会を務めない場合の１ヶ月あたりの罰金", 12000),
            array(208, true, "寮生大会無許可欠席２回", "", 1500),
            array(209, true, "寮生大会無許可欠席３回", "", 2500),
            array(210, true, "寮生大会無許可欠席４回", "", 4000),
            array(211, true, "クリーンデー無許可欠席罰金", "", 500),
            array(212, true, "寮費修正徴収", "寮費の徴収ミス修正などのための徴収", null),
            array(299, true, "その他の加算", "", null),
          
        );
        foreach ($items as $item) {
            $title = new PersonalAccountTitle;
            $title->id = $item[0];
            $title->is_payment = $item[1];
            $title->name = $item[2];
            $title->description = $item[3];
            $title->default_amount = $item[4];
            $title->save();
        }
    }
}
