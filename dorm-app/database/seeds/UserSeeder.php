<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // for ($i = 0; $i < 5; $i++) {
        //     DB::table('users')->insert([
        //         'name' => Str::random(10),
        //         'email' => Str::random(10) . '@gmail.com',
        //         'password' => Hash::make('password'),
        //         'created_at' => Carbon::now(),
        //         'updated_at' => Carbon::now()
        //     ]);
        // }
        DB::table('users')->insert([
            'name' => "田中一郎",
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => "鈴木二郎",
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        DB::table('users')->insert([
            'name' => "佐藤三郎",
            'email' => Str::random(10) . '@gmail.com',
            'password' => Hash::make('password'),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
