<?php

use Illuminate\Database\Seeder;
use App\RoleTitle;

class RoleTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $boss = new RoleTitle;
        $boss->title = "委員長";
        $boss->reward_amount = 100;
        $boss->reward_unit = "pct";
        $boss->save();

        $sub = new RoleTitle;
        $sub->title = "副委員長";
        $sub->reward_amount = 25;
        $sub->reward_unit = "pct";
        $sub->save();

        $director = new RoleTitle;
        $director->title = "総務";
        $director->reward_amount = 25;
        $director->reward_unit = "pct";
        $director->save();

        $accountant = new RoleTitle;
        $accountant->title = "会計委員";
        $accountant->reward_amount = 75;
        $accountant->reward_unit = "pct";
        $accountant->save();

        $auditor = new RoleTitle;
        $auditor->title = "監査";
        $auditor->reward_amount = 1000;
        $auditor->reward_unit = "jpy";
        $auditor->save();

        $facilitator = new RoleTitle;
        $facilitator->title = "議長";
        $facilitator->reward_amount = 1000;
        $facilitator->reward_unit = "jpy";
        $facilitator->save();
    }
}
