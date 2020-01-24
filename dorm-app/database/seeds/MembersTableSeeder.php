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
                "last_name" => "高畑",
                "first_name" => "裕次郎",
                "last_name_reading" => "タカハタ",
                "first_name_reading" => "ユウジロウ",
                'is_living' => false,

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
                "last_name" => "菊地",
                "first_name" => "信也",
                "last_name_reading" => "キクチ",
                "first_name_reading" => "ノブヤ",
                'room' => 203,

            ], [
                "last_name" => "関根",
                "first_name" => "定行",
                "last_name_reading" => "セキネ",
                "first_name_reading" => "サダユキ",
                'is_living' => false,
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
