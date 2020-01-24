<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class MembersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $members = [
            [
                'last_name' => '田中',
                'first_name' => '太郎',
                'last_name_reading' => 'タナカ',
                'first_name_reading' => 'タロウ',
                'room' => 101,
            ],
            [
                'last_name' => '佐藤',
                'first_name' => '一郎',
                'last_name_reading' => 'サトウ',
                'first_name_reading' => 'イチロウ',
                'room' => 102,
            ],
            [
                "last_name" => "深沢",
                "first_name" => "ひびき",
                "last_name_reading" => "フカサワ",
                "first_name_reading" => "ヒビキ",
                'room' => 103,
            ],
            [
                "last_name" => "冨田",
                "first_name" => "英充",
                "last_name_reading" => "トミタ",
                "first_name_reading" => "ヒデミツ",
                'room' => 105,

            ],
            [
                "last_name" => "星野",
                "first_name" => "家継",
                "last_name_reading" => "ホシノ",
                "first_name_reading" => "イエツグ",
                'room' => 106,

            ],
            [
                "last_name" => "滝沢",
                "first_name" => "雅義",
                "last_name_reading" => "タキサワ",
                "first_name_reading" => "マサヨシ",
                'room' => 109,

            ], [
                "last_name" => "堀江",
                "first_name" => "喜代信",
                "last_name_reading" => "ホリエ",
                "first_name_reading" => "キヨノブ",
                'room' => 110,

            ], [
                "last_name" => "松村",
                "first_name" => "吉治",
                "last_name_reading" => "マツムラ",
                "first_name_reading" => "キチジ",
                'room' => 111,

            ], [
                "last_name" => "甲斐",
                "first_name" => "久作",
                "last_name_reading" => "カイ",
                "first_name_reading" => "キュウサク",
                'room' => 113,

            ], [
                "last_name" => "古賀",
                "first_name" => "教夫",
                "last_name_reading" => "コガ",
                "first_name_reading" => "ノリオ",
                'room' => 115,

            ], [
                "last_name" => "豊田",
                "first_name" => "銀之助",
                "last_name_reading" => "トヨタ",
                "first_name_reading" => "ギンノスケ",
                'room' => 116,

            ], [
                "last_name" => "青柳",
                "first_name" => "敬",
                "last_name_reading" => "アオヤギ",
                "first_name_reading" => "タカシ",
                'room' => 118,

            ], [
                "last_name" => "菊地",
                "first_name" => "幸村",
                "last_name_reading" => "キクチ",
                "first_name_reading" => "ユキムラ",
                'room' => 119,

            ], [
                "last_name" => "手塚",
                "first_name" => "康三",
                "last_name_reading" => "テヅカ",
                "first_name_reading" => "ヤスゾウ",
                'room' => 120,

            ], [
                "last_name" => "中嶋",
                "first_name" => "康次",
                "last_name_reading" => "ナカシマ",
                "first_name_reading" => "コウジ",
                'room' => 123,

            ], [
                "last_name" => "森本",
                "first_name" => "弘春",
                "last_name_reading" => "モリモト",
                "first_name_reading" => "ヒロハル",
                'room' => 125,

            ], [
                "last_name" => "大野",
                "first_name" => "信介",
                "last_name_reading" => "オオノ",
                "first_name_reading" => "ノブスケ",
                'room' => 129,

            ], [
                "last_name" => "望月",
                "first_name" => "重行",
                "last_name_reading" => "モチヅキ",
                "first_name_reading" => "シゲユキ",
                'room' => 130,

            ], [
                "last_name" => "榎本",
                "first_name" => "重則",
                "last_name_reading" => "エノモト",
                "first_name_reading" => "シゲノリ",
                'room' => 131,

            ], [
                "last_name" => "篠原",
                "first_name" => "彰揮",
                "last_name_reading" => "シノハラ",
                "first_name_reading" => "ショウキ",
                'room' => 132,

            ], [
                "last_name" => "久保田",
                "first_name" => "昌昭",
                "last_name_reading" => "クボタ",
                "first_name_reading" => "マサアキ",
                'room' => 135,

            ], [
                "last_name" => "菊地",
                "first_name" => "信也",
                "last_name_reading" => "キクチ",
                "first_name_reading" => "ノブヤ",
                'room' => 203,

            ], [
                "last_name" => "宮内",
                "first_name" => "生三",
                "last_name_reading" => "ミヤウチ",
                "first_name_reading" => "イクゾウ",
                'room' => 206,

            ], [
                "last_name" => "武藤",
                "first_name" => "聖弘",
                "last_name_reading" => "ムトウ",
                "first_name_reading" => "キヨヒロ",
                'room' => 209,

            ], [
                "last_name" => "松田",
                "first_name" => "静市",
                "last_name_reading" => "マツダ",
                "first_name_reading" => "セイイチ",
                'room' => 211,

            ], [
                "last_name" => "宮内",
                "first_name" => "聡",
                "last_name_reading" => "クナイ",
                "first_name_reading" => "アキラ",
                'room' => 212,

            ], [
                "last_name" => "林",
                "first_name" => "戴三",
                "last_name_reading" => "ハヤシ",
                "first_name_reading" => "タイゾウ",
                'room' => 215,

            ], [
                "last_name" => "鶴田",
                "first_name" => "拓夫",
                "last_name_reading" => "ツルタ",
                "first_name_reading" => "タクオ",
                'room' => 219,

            ], [
                "last_name" => "畠山",
                "first_name" => "成彦",
                "last_name_reading" => "ハタケヤマ",
                "first_name_reading" => "ナルヒコ",
                'room' => 222,

            ], [
                "last_name" => "竹内",
                "first_name" => "忠秋",
                "last_name_reading" => "タケウチ",
                "first_name_reading" => "タダアキ",
                'room' => 228,

            ], [
                "last_name" => "関根",
                "first_name" => "定行",
                "last_name_reading" => "セキネ",
                "first_name_reading" => "サダユキ",
                'room' => 232,

            ], [
                "last_name" => "長谷川",
                "first_name" => "繁次",
                "last_name_reading" => "ハセガワ",
                "first_name_reading" => "シゲツグ",
                'room' => 233,

            ], [
                "last_name" => "小島",
                "first_name" => "茂也",
                "last_name_reading" => "コジマ",
                "first_name_reading" => "シゲヤ",
                'room' => 234,

            ], [
                "last_name" => "山岸",
                "first_name" => "友良",
                "last_name_reading" => "ヤマギシ",
                "first_name_reading" => "トモヨシ",
                'room' => 236,

            ], [
                "last_name" => "榊原",
                "first_name" => "裕康",
                "last_name_reading" => "サカキハラ",
                "first_name_reading" => "ヒロヤス",
                'room' => 237,
            ], [
                "last_name" => "青山",
                "first_name" => "要之助",
                "last_name_reading" => "アオヤマ",
                "first_name_reading" => "ヨウノスケ",
                'room' => 238,
            ], [
                "last_name" => "大城",
                "first_name" => "良弥",
                "last_name_reading" => "ダイジョウ",
                "first_name_reading" => "リョウヤ",
                'room' => 240,
            ]
        ];

        foreach ($members as $member) {
            DB::table('members')->insert($member);
        }
    }
}
