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
        // Apr, user 1
        $bill = new Billing;
        $bill->user_id = 1;
        $bill->closed_at = Carbon::create(2020, 04, 30);
        $bill->amount = 0; // temporary value
        $bill->save();

        $detsQuota = new BillingDetail;
        $detsQuota->billing_id = $bill->id;
        $detsQuota->personal_account_title_id = PersonalAccountTitle::where('name', '基本金請求')->first()->id;
        $detsQuota->abstract = "４月分基本金請求"; // this must be automatically generated from the params above
        $detsQuota->amount = 15434;
        $detsQuota->save();

        $detsPenalty = new BillingDetail;
        $detsPenalty->billing_id = $bill->id;
        $detsPenalty->personal_account_title_id = PersonalAccountTitle::where('name', 'ブロック掃除不履行罰金')->first()->id;
        $detsPenalty->abstract = "４月分ブロック掃除不履行罰金"; // this must be automatically generated from the params above
        $detsPenalty->amount = 2000;
        $detsPenalty->save();

        $bill->amount = $detsQuota->amount + $detsPenalty->amount;
        $bill->save();


        // May, user 1
        $bill = new Billing;
        $bill->user_id = 1;
        $bill->closed_at = Carbon::create(2020, 05, 31);
        $bill->amount = 0; // temporary value
        $bill->save();

        $detsQuota = new BillingDetail;
        $detsQuota->billing_id = $bill->id;
        $detsQuota->personal_account_title_id = PersonalAccountTitle::where('name', '基本金請求')->first()->id;
        $detsQuota->abstract = "５月分基本金請求"; // this must be automatically generated from the params above
        $detsQuota->amount = 19230;
        $detsQuota->save();

        $detsPenalty = new BillingDetail;
        $detsPenalty->billing_id = $bill->id;
        $detsPenalty->personal_account_title_id = PersonalAccountTitle::where('name', '風呂掃除不履行罰金')->first()->id;
        $detsPenalty->abstract = "５月分風呂掃除不履行罰金"; // this must be automatically generated from the params above
        $detsPenalty->amount = 4000;
        $detsPenalty->save();

        $bill->amount = $detsQuota->amount + $detsPenalty->amount;
        $bill->save();

        // Apr, user 2
        $bill = new Billing;
        $bill->user_id = 2;
        $bill->closed_at = Carbon::create(2020, 04, 30);
        $bill->amount = 0; // temporary value
        $bill->save();

        $detsQuota = new BillingDetail;
        $detsQuota->billing_id = $bill->id;
        $detsQuota->personal_account_title_id = PersonalAccountTitle::where('name', '基本金請求')->first()->id;
        $detsQuota->abstract = "４月分基本金請求"; // this must be automatically generated from the params above
        $detsQuota->amount = 15434;
        $detsQuota->save();

        $detsReward = new BillingDetail;
        $detsReward->billing_id = $bill->id;
        $detsReward->personal_account_title_id = PersonalAccountTitle::where('name', '議長報酬')->first()->id;
        $detsReward->abstract = "４月分議長報酬"; // this must be automatically generated from the params above
        $detsReward->amount = -2000;
        $detsReward->save();

        $bill->amount = $detsQuota->amount + $detsReward->amount;
        $bill->save();
    }
}
