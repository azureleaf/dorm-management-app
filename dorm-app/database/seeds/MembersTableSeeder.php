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
        $param = [
            'name' => 'Michael Scott',
            'room' => 101,
        ];
        DB::table('members')->insert($param);

        $param = [
            'name' => 'Sheldon Cooper',
            'room' => 102,
        ];
        DB::table('members')->insert($param);

        $param = [
            'name' => 'Vincent Vega',
            'room' => 103,
        ];
        DB::table('members')->insert($param);

        $param = [
            'name' => 'Anakin Skywalker',
            'room' => 104,
        ];
        DB::table('members')->insert($param);

        $param = [
            'name' => 'John Brand',
            'room' => 105,
        ];
        DB::table('members')->insert($param);
    }
}
