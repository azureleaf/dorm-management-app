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

        // Seed all the empty rooms
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

                // Create all the rooms
                DB::table('rooms')->insert([
                    'number' => $floor . $room,
                    'comment' => "",
                    'status' => 'vacant',
                    'block' => $block,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
            }
        }

        // List existing user IDs & room numbers in the DB
        $userIds = App\User::where("move_out_at", NULL)->pluck('id')->toArray();
        $roomNums = App\Room::all()->pluck('number')->toArray();

        $roomNums = $this->randArray($roomNums); // randomize

        // Seed occupied rooms with users in the user table
        foreach ($userIds as $index => $userId) {
            DB::table('rooms')
                ->where('number', $roomNums[$index])
                ->update(
                    [
                        'user_id' => $userId,
                        'status' => 'occupied'
                    ]
                );
        }

        // Seed unavailable rooms
        for ($i = 0; $i < 8; $i++) {
            DB::table('rooms')
                ->where('number', $roomNums[$i + count($userIds)])
                ->update([
                    'comment' => "暖房器具なし",
                    'status' => 'unavailable'
                ]);
        }
    }

    // get an array, randomize the elements order of the array
    private function randArray($orderedArr, $randomArr = array())
    {
        if (count($orderedArr) == 0) {
            return $randomArr;
        } else {
            $keys = array_keys($orderedArr);
            $i = $keys[rand(0, count($keys) - 1)];
            array_push($randomArr, $orderedArr[$i]);
            $diff = array_diff($orderedArr, array($orderedArr[$i]));
            return $this->randArray($diff, $randomArr);
        }
    }
}
