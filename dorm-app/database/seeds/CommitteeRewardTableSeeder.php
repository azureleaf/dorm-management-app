<?php

use Illuminate\Database\Seeder;

class CommitteeRewardTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'committee_role' => '委員長',
                'payment_percentages' => 0,
                'number_of_people' => 1,
            ],
            [
                'committee_role' => '副委員長',
                'payment_percentages' => 75,
                'number_of_people' => 1,
            ],
            [
                'committee_role' => '総務',
                'payment_percentages' => 75,
                'number_of_people' => 1,
            ],
            [
                'committee_role' => '会計委員',
                'payment_percentages' => 25,
                'number_of_people' => 3,
            ],
        ];

        foreach ($roles as $role) {
            DB::table('committee_reward')->insert($role);
        }
    }
}
