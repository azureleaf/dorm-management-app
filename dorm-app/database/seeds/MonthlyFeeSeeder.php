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
            array(2019, 9, Carbon::create(2019, 10, 10), Carbon::create(2019, 10, 22), rand(800000, 150000), 87, 85.75),
            array(2019, 10, Carbon::create(2019, 11, 11), Carbon::create(2019, 11, 21), rand(800000, 150000), 80, 85),
            array(2019, 11, Carbon::create(2019, 12, 8), Carbon::create(2019, 12, 15), 820436, 90, 85.5),
            array(2019, 12, Carbon::create(2019, 1, 15), Carbon::create(2019, 1, 22), 710436, 90, 84.25),
            array(2020, 1, Carbon::create(2020, 2, 12), Carbon::create(2020, 2, 18), 855436, 88, 82),
            array(2020, 2, Carbon::create(2020, 3, 10), Carbon::create(2020, 3, 20), 655436, 85, 76.25),
            array(2020, 3, Carbon::create(2020, 4, 10), Carbon::create(2020, 4, 20), 555436, 82, 75.5),
            array(2020, 4, Carbon::create(2020, 5, 6), Carbon::create(2020, 5, 24), 632438, 84, 75),
        );
        foreach ($fees as $fee) {
            $newFee = MonthlyFee::create([
                "year" => $fee[0],
                "month" => $fee[1],
                "closed_at" => $fee[2],
                "approved_at" => $fee[3],
                "total_amount" => $fee[4],
                "persons" => $fee[5],
                "persons_after_deduction" => $fee[6],
                "fee_amount" => ceil($fee[4] / $fee[6]),
            ]);
            $newFee->save();
        }
    }
}
