<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoleHistoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userIds = App\User::all()->pluck('id')->toArray();

        $boss1 = new App\RoleHistory();
        $boss1->user_id = $userIds[11];
        $boss1->role_title_id = App\RoleTitle::where("name", "委員長")->first()->id;
        $boss1->start_at = Carbon::create(2020, 01, 01);
        $boss1->end_at = Carbon::create(2020, 03, 31);
        $boss1->reward_pct = 100;
        $boss1->save();

        $accountant1 = new App\RoleHistory();
        $accountant1->user_id = $userIds[14];
        $accountant1->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        $accountant1->start_at = Carbon::create(2020, 01, 01);
        $accountant1->end_at = Carbon::create(2020, 03, 31);
        $accountant1->reward_pct = 75;
        $accountant1->save();

        $accountant2 = new App\RoleHistory();
        $accountant2->user_id = $userIds[18];
        $accountant2->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        $accountant2->start_at = Carbon::create(2020, 01, 01);
        $accountant2->end_at = Carbon::create(2020, 03, 31);
        $accountant2->reward_pct = 75;
        $accountant2->save();
    }
}
