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
        $this->call([
            UserSeeder::class,
            // BillingSeeder::class,
            RoomSeeder::class,
            RoleTitleSeeder::class,
            RoleHistoriesTableSeeder::class,
            PersonalAccountTitleSeeder::class,
            BillingDetailSeeder::class,
            MonthlyFeeSeeder::class
        ]);
    }
}
