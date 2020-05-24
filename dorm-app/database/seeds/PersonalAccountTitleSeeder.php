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
            array(true, "寮費支払", "", null),
            array(true, "風呂掃除罰金", "", 4000),
            array(true, "脱衣所掃除罰金", "", 1000),
            array(true, "ブロック掃除罰金", "", 2000),
            array(true, "寮費滞納罰金", "4ヶ月以上滞納し、かつ寮生大会で弁明が認められなかった場合", 1000),
            array(true, "ブロック長不履行罰金", "代わりを見つけずにブロック長を務めない場合の１ヶ月あたりの罰金", 100),
            array(true, "委員不履行罰金", "代わりを見つけずに委員会を務めない場合の１ヶ月あたりの罰金", 12000),
            array(true, "寮生大会無許可欠席２回", "", 1500),
            array(true, "寮生大会無許可欠席３回", "", 2500),
            array(true, "寮生大会無許可欠席４回", "", 4000),
            array(true, "クリーンデー無許可欠席罰金", "", 500),
            array(true, "寮費修正徴収", "寮費の徴収ミス修正などのための徴収", null),
            array(true, "その他の徴収", "", null),
            array(false, "風呂掃除無許可欠席者代行報酬", "", 4000),
            array(false, "ブロック掃除無許可欠席者代行報酬", "", 2000),
            array(false, "クリーンデー参加者報酬", "欠席者の罰金合計を出席者で頭割り", null),
            array(false, "監査報酬", "", null),
            array(false, "議長報酬", "", 2000),
            array(false, "寮費修正返還", "寮費の徴収ミス修正などのための返還", null),
            array(false, "その他の報酬", "", null),
        );
        foreach ($items as $item) {
            $title = new PersonalAccountTitle;
            $title->is_payment = $item[0];
            $title->name = $item[1];
            $title->description = $item[2];
            $title->default_amount = $item[3];
            $title->save();
        }
    }
}
