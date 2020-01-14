<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [[
            'date' => Carbon::create(2000, 3, 1, 0, 0, 0, 'Asia/Tokyo'),
            'member_id' => 1,
            'description' => '前期より繰越',
            'amount' => 12345,
            'balance' => 12345,
        ], [
            'date' => Carbon::create(2000, 3, 10, 21, 0, 0, 'Asia/Tokyo'),
            'member_id' => 1,
            'description' => '3月分寮費請求',
            'amount' => 12000,
            'balance' => 24345,
        ], [
            'date' => Carbon::create(2000, 3, 10, 22, 0, 0, 'Asia/Tokyo'),
            'member_id' => 1,
            'description' => '3月分罰金請求',
            'amount' => 3000,
            'balance' => 27345,
        ], [
            'date' => Carbon::create(2000, 3, 20, 18, 0, 0, 'Asia/Tokyo'),
            'member_id' => 1,
            'description' => '2月分支払',
            'amount' => -14000,
            'balance' => 13345,
        ], [
            'date' => Carbon::create(2000, 3, 1, 0, 0, 0, 'Asia/Tokyo'),
            'member_id' => 2,
            'description' => '前期より繰越',
            'amount' => 25000,
            'balance' => 25000,
        ], [
            'date' => Carbon::create(2000, 3, 10, 21, 0, 0, 'Asia/Tokyo'),
            'member_id' => 2,
            'description' => '3月分寮費請求',
            'amount' => 12000,
            'balance' => 37000,
        ], [
            'date' => Carbon::create(2000, 3, 20, 18, 0, 0, 'Asia/Tokyo'),
            'member_id' => 2,
            'description' => '2月分支払',
            'amount' => -14000,
            'balance' => 23000,
        ]];

        foreach ($items as $item) {
            DB::table('payments')->insert($item);
        }
    }
}
