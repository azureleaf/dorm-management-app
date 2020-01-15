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
            'name' => 'Michael Scott',
            'room' => 101,
        ],
        [
            'name' => 'Sheldon Cooper',
            'room' => 102,
        ],
        [
            'name' => 'Vincent Vega',
            'room' => 103,
        ],
        [
            'name' => 'Anakin Skywalker',
            'room' => 104,
        ],
        [
            'name' => 'John Brand',
            'room' => 105,
        ],
        ];

        foreach ($members as $member) {
            DB::table('members')->insert($member);
        }
    }
}
