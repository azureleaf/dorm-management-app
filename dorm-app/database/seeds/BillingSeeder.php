<!-- 
    This seeder is commented out in DatabaseSeeder.php!
    because seeding to this table will be done in BillingDetailsSeeder.php!
-->
<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;


class BillingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $billAmount = rand(0, 10000);
        $users = App\User::all()->pluck('id')->toArray();
        $userIdIndexRand = rand(0, count($users) - 1);
        $userIdRand = $users[$userIdIndexRand];

        DB::table('billings')->insert([
            'abstract' => "５月分寮費請求",
            'billing' => $billAmount,
            'payment' => 0,
            'balance' => $billAmount + 10000,
            'user_id' => $userIdRand,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('billings')->insert([
            'abstract' => "５月分寮費支払",
            'billing' => 0,
            'payment' => $billAmount,
            'balance' => 10000,
            'user_id' => $userIdRand,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
