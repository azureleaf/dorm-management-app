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

                // set block number of the rooms
                if (intval($floor . $room) < 115) {
                    $block = 1;
                } else if (intval($floor . $room) < 125) {
                    $block = 2;
                } else if (intval($floor . $room) < 140) {
                    $block = 3;
                } else if (intval($floor . $room) < 215) {
                    $block = 4;
                } else if (intval($floor . $room) < 225) {
                    $block = 5;
                } else if (intval($floor . $room) < 240) {
                    $block = 6;
                }

                DB::table('rooms')->insert([
                    'room' => $floor . $room,
                    'comment' => "",
                    'status' => 'vacant',
                    'block' => $block,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        // add unavailable room with a comment
        DB::table('rooms')
            ->where('room', 201)
            ->update([
                'comment' => "錠前破損、暖房なし",
                'status' => 'unavailable'
            ]);

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
            ->where('room', 103)
            ->update(
                [
                    'user_id' => '1',
                    'status' => 'occupied'
                ]
            );

        DB::table('rooms')
            ->where('room', 108)
            ->update(
                [
                    'user_id' => '2',
                    'status' => 'occupied'
                ]
            );

        DB::table('rooms')
            ->where('room', 115)
            ->update(
                [
                    'user_id' => '3',
                    'status' => 'occupied'
                ]
            );
    }
}
