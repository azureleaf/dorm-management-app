<?php

use Illuminate\Database\Seeder;
use App\BillingDetail;
use App\Billing;
use App\PersonalAccountTitle;
use Carbon\Carbon;

class BillingDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billApr = new Billing;
        $billApr->user_id = 1;
        $billApr->closed_at = Carbon::create(2020, 04, 31);
        $billApr->amount = 0; // temporary value
        $billApr->save();

        $detsQuota = new BillingDetail;
        $detsQuota->billing_id = $billApr->id;
        $detsQuota->personal_account_title_id = PersonalAccountTitle::where('name', '基本金請求')->first()->id;
        $detsQuota->abstract = "４月分基本金請求"; // this must be automatically generated from the params above
        $detsQuota->amount = 15434;
        $detsQuota->save();

        $detsPenalty = new BillingDetail;
        $detsPenalty->billing_id = $billApr->id;
        $detsPenalty->personal_account_title_id = PersonalAccountTitle::where('name', 'ブロック掃除不履行罰金')->first()->id;
        $detsPenalty->abstract = "４月分ブロック掃除不履行罰金"; // this must be automatically generated from the params above
        $detsPenalty->amount = 2000;
        $detsPenalty->save();

        $billApr->amount = $detsQuota->amount + $detsPenalty->amount;
        $billApr->save();
    }
}
