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
        $boss->name = "委員長";
        $boss->default_reward_pct = 100;
        $boss->save();

        $sub = new RoleTitle;
        $sub->name = "副委員長";
        $sub->default_reward_pct = 25;
        $sub->save();

        $director = new RoleTitle;
        $director->name = "総務";
        $director->default_reward_pct = 25;
        $director->save();

        $accountant = new RoleTitle;
        $accountant->name = "会計委員";
        $accountant->default_reward_pct = 75;
        $accountant->save();
    }
}
