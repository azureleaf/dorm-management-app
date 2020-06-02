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
        $boss1->start_at = Carbon::create(2020, 1, 01);
        $boss1->end_at = Carbon::create(2020, 3, 31);
        $boss1->reward_pct = 100;
        $boss1->save();

        $boss2 = new App\RoleHistory();
        $boss2->user_id = $userIds[13];
        $boss2->role_title_id = App\RoleTitle::where("name", "委員長")->first()->id;
        $boss2->start_at = Carbon::create(2020, 6, 01);
        $boss2->end_at = Carbon::create(2020, 9, 30);
        $boss2->reward_pct = 100;
        $boss2->save();

        $sub = new App\RoleHistory();
        $sub->user_id = $userIds[8];
        $sub->role_title_id = App\RoleTitle::where("name", "副委員長")->first()->id;
        $sub->start_at = Carbon::create(2020, 6, 01);
        $sub->end_at = Carbon::create(2020, 9, 30);
        $sub->reward_pct = 25;
        $sub->save();

        $director = new App\RoleHistory();
        $director->user_id = $userIds[10];
        $director->role_title_id = App\RoleTitle::where("name", "総務")->first()->id;
        $director->start_at = Carbon::create(2020, 6, 01);
        $director->end_at = Carbon::create(2020, 9, 30);
        $director->reward_pct = 25;
        $director->save();

        $accountant1 = new App\RoleHistory();
        $accountant1->user_id = $userIds[14];
        $accountant1->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        $accountant1->start_at = Carbon::create(2020, 6, 01);
        $accountant1->end_at = Carbon::create(2020, 9, 30);
        $accountant1->reward_pct = 75;
        $accountant1->save();

        $accountant2 = new App\RoleHistory();
        $accountant2->user_id = $userIds[18];
        $accountant2->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        $accountant2->start_at = Carbon::create(2020, 6, 01);
        $accountant2->end_at = Carbon::create(2020, 9, 30);
        $accountant2->reward_pct = 75;
        $accountant2->save();


    }
}
