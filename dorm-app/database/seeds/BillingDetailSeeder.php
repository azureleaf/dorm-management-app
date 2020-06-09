<?php

use Illuminate\Database\Seeder;
use App\BillingDetail;
use App\Billing;
use App\User;
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
        // List all the users
        $userIds = App\User::all()->pluck('id')->toArray();

        // Bill the same amount to all the users
        foreach ($userIds as $userId) {

            $months = array(
                array(
                    "amount" => 14550,
                    "closedAt" => Carbon::create(2020, 01, 31),
                    "abstract" => "１月分基本金請求",
                    "paidAt" => Carbon::create(2020, 2, 16)
                ),
                array(
                    "amount" => 11234,
                    "closedAt" => Carbon::create(2020, 02, 29),
                    "abstract" => "２月分基本金請求",
                    // Most users pay, while some assholes don't
                    "paidAt" => rand(1, 6) > 5 ? null : Carbon::create(2020, 3, 21)
                ),
                array(
                    "amount" => 12365,
                    "closedAt" => Carbon::create(2020, 03, 30),
                    "abstract" => "３月分基本金請求"
                ),
            );

            foreach ($months as $month) {
                $amountSum = 0;

                $bill = Billing::create([
                    "user_id" => $userId,
                    "closed_at" => $month["closedAt"],
                    "amount" => 0, // Will be updated soon
                    "paid_at" => array_key_exists("paidAt", $month) ? $month["paidAt"] : null,
                    "is_next_debit_target" => array_key_exists("paidAt", $month) ? false : true
                ]);
                $bill->save();

                $detsQuota =  BillingDetail::create([
                    "billing_id" => $bill->id,
                    "personal_account_title_id" => PersonalAccountTitle::where('name', '基本金請求')->first()->id,
                    "abstract" => $month["abstract"], // this must be automatically generated from the params above
                    "amount" => $month["amount"],
                ]);
                $amountSum += $month["amount"];
                $detsQuota->save();

                // Randomly impose penalty
                if (rand(1, 5) > 4) {
                    $detsPenalty = BillingDetail::create([
                        "billing_id" => $bill->id,
                        "personal_account_title_id" => PersonalAccountTitle::where('name', 'ブロック掃除不履行罰金')->first()->id,
                        "abstract" => "ブロック掃除不履行罰金",
                        "amount" => 2000,
                    ]);
                    $amountSum += 2000;
                    $detsPenalty->save();
                }

                // Randomly reward
                if (rand(1, 5) > 4) {
                    $detsReward = BillingDetail::create([
                        "billing_id" => $bill->id,
                        "personal_account_title_id" => PersonalAccountTitle::where('name', '風呂掃除無許可欠席者代行報酬')->first()->id,
                        "abstract" => "風呂掃除無許可欠席者代行報酬",
                        "amount" => -4000,
                    ]);
                    $amountSum += -4000;

                    $detsReward->save();
                }

                $bill->amount = $amountSum;
                $bill->save();
            }
        }
    }
}
