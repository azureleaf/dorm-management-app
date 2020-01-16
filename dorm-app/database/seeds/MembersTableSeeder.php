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
        ];

        foreach ($members as $member) {
            DB::table('members')->insert($member);
        }
    }
}
