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
        $userIds = User::all()->pluck('id')->toArray();

        // Bill the same amount to all the users
        foreach ($userIds as $userId) {

            // 25 % of the users have unpaid fees
            // Non-payers has arrears for 1 / 2 / 3 months
            $unpaidMonths = rand(0, 3) == 3 ? rand(1, 3) : 0;

            $months = array(
                array(
                    "amount" => 15764,
                    "closedAt" => Carbon::create(2019, 11, 30),
                    "abstract" => "基本金請求",
                    "paidAt" => Carbon::create(2020, 12, 14)
                ),
                array(
                    "amount" => 16202,
                    "closedAt" => Carbon::create(2019, 12, 31),
                    "abstract" => "基本金請求",
                    "paidAt" => $unpaidMonths > 2 ? null : Carbon::create(2020, 1, 15)
                ),
                array(
                    "amount" => 14550,
                    "closedAt" => Carbon::create(2020, 01, 31),
                    "abstract" => "基本金請求",
                    "paidAt" => $unpaidMonths > 1 ? null : Carbon::create(2020, 2, 16)
                ),
                array(
                    "amount" => 11234,
                    "closedAt" => Carbon::create(2020, 02, 29),
                    "abstract" => "基本金請求",
                    "paidAt" => $unpaidMonths > 0 ? null : Carbon::create(2020, 3, 21)
                ),
                array(
                    "amount" => 12365,
                    "closedAt" => Carbon::create(2020, 03, 31),
                    "abstract" => "基本金請求"
                    // "paidAt" => // All the users are at unpaid status for the latest billing
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
