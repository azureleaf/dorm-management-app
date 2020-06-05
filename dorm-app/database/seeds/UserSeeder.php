<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Systematically generate names
        $familyNames = array("鈴木", "佐藤", "田中", "高橋", "中村", "伊藤", "渡辺");
        $firstNames = array("一郎", "次郎", "三郎", "四郎", "五郎", "六郎", "七郎");
        $names = array();
        foreach ($familyNames as $familyName) {
            foreach ($firstNames as $firstName) {
                array_push($names, array($familyName, $firstName));
            }
        }

        // randomize the order of the names
        // $names = $this->randArray($names);

        // Seed some users
        // Note that number of users added here must be fewer than generated names
        for ($i = 0; $i < 30; $i++) {
            $newUser = User::create([
                'name_family_kanji' => $names[$i][0],
                'name_first_kanji' => $names[$i][1],
                'name_family_kana' => "ミョウジサンプル",
                'name_first_kana' => "ナマエサンプル",
                'email' => Str::random(10) . '@dc.aoba.ac.jp',
                'password' => Hash::make('password'),

                // Random dates between 2020-1-1 and 2020-3-31
                'move_in_at' => Carbon::create(2020, 01, 01)
                    ->addMonths(rand(0, 2))
                    ->addDays(rand(0, 30)),

                // Random dates between 2020-4-1 and 2020-7-1
                // Some are null (that is, still lives till today)
                'move_out_at' => rand(0, 6) > 4 ? Carbon::create(2020, 4, 1)
                    ->addMonths(rand(0, 2))
                    ->addDays(rand(0, 30)) :
                    NULL,
            ]);
            $newUser->save();
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
