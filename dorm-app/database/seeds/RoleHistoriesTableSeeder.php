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
        // $userIds = App\User::all()->pluck('id')->toArray();

        $members2019_03 = array(
            array(11, "委員長", 100),
            array(4, "副委員長", 25),
            array(5, "総務", 25),
            array(7, "会計委員", 75),
            array(10, "会計委員", 75)
        );

        foreach($members2019_03 as $member){
            $hx = new App\RoleHistory();
            $hx->user_id = $member[0];
            $hx->role_title_id = App\RoleTitle::where("name", $member[1])->first()->id;
            $hx->reward_pct = $member[2];
            $hx->fiscal_year = 2019;
            $hx->term = 3;
            $hx->start_at = Carbon::create(2020, 2, 1);
            $hx->end_at = Carbon::create(2020, 5, 31);
            $hx->save();
        }

        $members2020_01 = array(
            array(13, "委員長", 100),
            array(8, "副委員長", 25),
            array(3, "総務", 25),
            array(2, "会計委員", 75),
            array(6, "会計委員", 75),
            array(12, "会計委員", 100),
            array(14, "会計委員", 100),
            array(15, "会計委員", 50)
        );

        foreach($members2020_01 as $member){
            $hx = new App\RoleHistory();
            $hx->user_id = $member[0];
            $hx->role_title_id = App\RoleTitle::where("name", $member[1])->first()->id;
            $hx->reward_pct = $member[2];
            $hx->fiscal_year = 2020;
            $hx->term = 1;
            $hx->start_at = Carbon::create(2020, 6, 1);
            $hx->end_at = Carbon::create(2020, 9, 30);
            $hx->save();
        }

        // $boss3 = new App\RoleHistory();
        // $boss3->user_id = $userIds[11];
        // $boss3->role_title_id = App\RoleTitle::where("name", "委員長")->first()->id;
        // $boss3->start_at = Carbon::create(2020, 2, 01);
        // $boss3->end_at = Carbon::create(2020, 5, 31);
        // $boss3->reward_pct = 100;
        // $boss3->save();

        // $sub3 = new App\RoleHistory();
        // $sub3->user_id = $userIds[4];
        // $sub3->role_title_id = App\RoleTitle::where("name", "副委員長")->first()->id;
        // $sub3->start_at = Carbon::create(2020, 2, 01);
        // $sub3->end_at = Carbon::create(2020, 5, 31);
        // $sub3->reward_pct = 25;
        // $sub3->save();

        // $director3 = new App\RoleHistory();
        // $director3->user_id = $userIds[5];
        // $director3->role_title_id = App\RoleTitle::where("name", "総務")->first()->id;
        // $director3->start_at = Carbon::create(2020, 2, 01);
        // $director3->end_at = Carbon::create(2020, 5, 31);
        // $director3->reward_pct = 25;
        // $director3->save();

        // $accountant3_1 = new App\RoleHistory();
        // $accountant3_1->user_id = $userIds[7];
        // $accountant3_1->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        // $accountant3_1->start_at = Carbon::create(2020, 2, 01);
        // $accountant3_1->end_at = Carbon::create(2020, 5, 31);
        // $accountant3_1->reward_pct = 75;
        // $accountant3_1->save();

        // $accountant3_2 = new App\RoleHistory();
        // $accountant3_2->user_id = $userIds[11];
        // $accountant3_2->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        // $accountant3_2->start_at = Carbon::create(2020, 2, 01);
        // $accountant3_2->end_at = Carbon::create(2020, 5, 31);
        // $accountant3_2->reward_pct = 75;
        // $accountant3_2->save();

        // 2020 - 1st
        // $boss1 = new App\RoleHistory();
        // $boss1->user_id = $userIds[13];
        // $boss1->role_title_id = App\RoleTitle::where("name", "委員長")->first()->id;
        // $boss1->start_at = Carbon::create(2020, 6, 01);
        // $boss1->end_at = Carbon::create(2020, 9, 30);
        // $boss1->reward_pct = 100;
        // $boss1->save();

        // $sub1 = new App\RoleHistory();
        // $sub1->user_id = $userIds[8];
        // $sub1->role_title_id = App\RoleTitle::where("name", "副委員長")->first()->id;
        // $sub1->start_at = Carbon::create(2020, 6, 01);
        // $sub1->end_at = Carbon::create(2020, 9, 30);
        // $sub1->reward_pct = 25;
        // $sub1->save();

        // $director1 = new App\RoleHistory();
        // $director1->user_id = $userIds[10];
        // $director1->role_title_id = App\RoleTitle::where("name", "総務")->first()->id;
        // $director1->start_at = Carbon::create(2020, 6, 01);
        // $director1->end_at = Carbon::create(2020, 9, 30);
        // $director1->reward_pct = 25;
        // $director1->save();

        // $accountant1_1 = new App\RoleHistory();
        // $accountant1_1->user_id = $userIds[14];
        // $accountant1_1->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        // $accountant1_1->start_at = Carbon::create(2020, 6, 01);
        // $accountant1_1->end_at = Carbon::create(2020, 9, 30);
        // $accountant1_1->reward_pct = 75;
        // $accountant1_1->save();

        // $accountant1_2 = new App\RoleHistory();
        // $accountant1_2->user_id = $userIds[18];
        // $accountant1_2->role_title_id = App\RoleTitle::where("name", "会計委員")->first()->id;
        // $accountant1_2->start_at = Carbon::create(2020, 6, 01);
        // $accountant1_2->end_at = Carbon::create(2020, 9, 30);
        // $accountant1_2->reward_pct = 75;
        // $accountant1_2->save();
    }
}
