<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MembersTableSeeder::class);
        $this->call(PaymentsTableSeeder::class);
        $this->call(PaymentCategoriesTableSeeder::class);
        $this->call(CommitteeRewardTableSeeder::class);
    }
}
