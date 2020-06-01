<?php

use Illuminate\Database\Seeder;
use App\FundTitle;
use Carbon\Carbon;
use PhpParser\Node\Expr\FuncCall;

class FundTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $general = new FundTitle;
        $general->name = "一般会計";
        $general->save();

        $penalty = new FundTitle;
        $penalty->name = "罰金会計";
        $penalty->save();

        $party = new FundTitle;
        $party->name = "コンパ積立金";
        $party->monthly_reserve_amount = 22500;
        $party->save();

        $network = new FundTitle;
        $network->name = "ネットワーク設備積立金";
        $network->monthly_reserve_amount = 5000;
        $network->start_at = Carbon::create(2020, 01, 01);
        $network->end_at = Carbon::create(2020, 12, 01);
        $network->save();
    }
}
