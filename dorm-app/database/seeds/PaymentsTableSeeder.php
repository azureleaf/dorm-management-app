<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $param = [
            'member_id' => 1,
            'description' => '前期より繰越',
            'amount' => 12345,
            'balance' => 12345,
        ];
        DB::table('payments')->insert($param);

        $param = [
            'member_id' => 1,
            'description' => '3月分寮費',
            'amount' => 12000,
            'balance' => 24345,
        ];
        DB::table('payments')->insert($param);

        $param = [
            'member_id' => 1,
            'description' => '3月分罰金',
            'amount' => 3000,
            'balance' => 27345,
        ];
        DB::table('payments')->insert($param);

        $param = [
            'member_id' => 1,
            'description' => '2月分支払',
            'amount' => -14000,
            'balance' => 13345,
        ];
        DB::table('payments')->insert($param);
    }
}
