<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // List of existing user IDs in the user table
        $users = App\User::all()->pluck('id')->toArray();

        // Create all the rooms
        foreach (range(1, 2) as $floor) {
            foreach (range(1, 40) as $room) {
                $room = strval($room);
                $room = strlen($room) == 2 ? $room : "0" . $room;
                DB::table('rooms')->insert([
                    'room' => $floor . $room,
                    // 'comment' => "",
                    'update_type' => "moveout",
                    // 'user_id' => "",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        // Add comment to a room
        DB::table('rooms')->insert([
            'room' => 201,
            'comment' => "錠前破損、暖房なし",
            'update_type' => "maintain",
            // 'user_id' => "",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        // Pick a user randomly
        $userIdIndexRand = rand(0, count($users) - 1);

        // New move into a room
        DB::table('rooms')->insert([
            'room' => 202,
            'comment' => "",
            'update_type' => "movein",
            'user_id' => "$users[$userIdIndexRand]",
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
