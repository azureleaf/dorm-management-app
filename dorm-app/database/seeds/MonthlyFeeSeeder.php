<?php

use Illuminate\Database\Seeder;
use App\MonthlyFee;
use Carbon\Carbon;

class MonthlyFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $fees = array(
            array(Carbon::create(2019, 9, 30), rand(800000, 150000), 87, 85.75),
            array(Carbon::create(2019, 10, 31), rand(800000, 150000), 80, 85),
            array(Carbon::create(2019, 11, 30), 820436, 90, 85.5),
            array(Carbon::create(2019, 12, 31), 710436, 90, 84.25),
            array(Carbon::create(2020, 1, 31), 855436, 88, 82),
            array(Carbon::create(2020, 2, 29), 655436, 85, 76.25),
            array(Carbon::create(2020, 3, 31), 555436, 82, 75.5),
            array(Carbon::create(2020, 4, 30), 632438, 84, 75),
        );
        foreach ($fees as $fee) {
            $newFee = MonthlyFee::create([
                "closed_at" => $fee[0],
                "total_amount" => $fee[1],
                "persons" => $fee[2],
                "persons_after_deduction" => $fee[3],
                "fee_amount" => ceil($fee[1] / $fee[3]),
            ]);
            $newFee->save();
        }
    }
}
