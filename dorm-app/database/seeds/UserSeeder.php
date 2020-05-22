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
        // Systematically generate names
        $familyNames = array("鈴木", "佐藤", "田中", "高橋", "中村", "伊藤", "渡辺");
        $firstNames = array("一郎", "次郎", "三郎", "四郎", "五郎", "六郎", "七郎");
        $names = array();
        foreach ($familyNames as $familyName) {
            foreach ($firstNames as $firstName) {
                array_push($names, $familyName . $firstName);
            }
        }

        // randomize the order of the names
        $names = $this->randArray($names);

        // Seed some users
        // Note that number of users added here must be fewer than generated names
        for ($i = 0; $i < 20; $i++) {
            DB::table('users')->insert([
                'name' => $names[$i],
                'email' => Str::random(10) . '@dcmail.com',
                'password' => Hash::make('password'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
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
