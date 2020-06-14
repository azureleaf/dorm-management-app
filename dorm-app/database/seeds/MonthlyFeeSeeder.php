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
            array(2019, 9, Carbon::create(2019, 10, 10), rand(800000, 150000), 87, 85.75),
            array(2019, 10, Carbon::create(2019, 11, 11), rand(800000, 150000), 80, 85),
            array(2019, 11, Carbon::create(2019, 12, 8), 820436, 90, 85.5),
            array(2019, 12, Carbon::create(2019, 1, 15), 710436, 90, 84.25),
            array(2020, 1, Carbon::create(2020, 2, 12), 855436, 88, 82),
            array(2020, 2, Carbon::create(2020, 3, 10), 655436, 85, 76.25),
            array(2020, 3, Carbon::create(2020, 4, 10), 555436, 82, 75.5),
            array(2020, 4, Carbon::create(2020, 5, 6), 632438, 84, 75),
        );
        foreach ($fees as $fee) {
            $newFee = MonthlyFee::create([
                "year" => $fee[0],
                "month" => $fee[1],
                "closed_at" => $fee[2],
                "total_amount" => $fee[3],
                "persons" => $fee[4],
                "persons_after_deduction" => $fee[5],
                "fee_amount" => ceil($fee[3] / $fee[5]),
            ]);
            $newFee->save();
        }
    }
}
