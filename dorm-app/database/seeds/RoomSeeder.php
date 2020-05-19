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
                    // 'update_type' => "moveout",
                    // 'user_id' => "",
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        // Add comment to a room
        // DB::table('room_histories')->insert([
        //     'room' => 201,
        //     'comment' => "錠前破損、暖房なし",
        //     // 'user_id' => "",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        // Pick a user randomly
        $userIdIndexRand = rand(0, count($users) - 1);

        // DB::table('rooms')->insert([
        //     'room' => 203,
        //     'comment' => "",
        //     'user_id' => "$users[$userIdIndexRand]",
        //     'user_id' => "1",
        //     'created_at' => Carbon::now(),
        //     'updated_at' => Carbon::now()
        // ]);

        DB::table('rooms')
            ->where('room', 211)
            ->update(
                [
                    'user_id' => '1'
                ]
            );

        DB::table('rooms')
            ->where('room', 212)
            ->update(
                [
                    'user_id' => '2'
                ]
            );

        DB::table('rooms')
            ->where('room', 213)
            ->update(
                [
                    'user_id' => '3'
                ]
            );
    }
}
