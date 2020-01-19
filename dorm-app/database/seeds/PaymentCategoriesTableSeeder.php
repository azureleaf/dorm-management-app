<?php

use Illuminate\Database\Seeder;

class PaymentCategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            [
                'cat_id' => 101,
                'cat_title' => "基本金請求",
            ],
            [
                'cat_id' => 102,
                'cat_title' => "寮費調整のための請求",
            ],
            [
                'cat_id' => 111,
                'cat_title' => "罰金請求（風呂掃除放棄）",
            ],
            [
                'cat_id' => 112,
                'cat_title' => "罰金請求（ブロック清掃放棄）",
            ],
            [
                'cat_id' => 113,
                'cat_title' => "罰金請求（クリーンデー欠席）",
            ],
            [
                'cat_id' => 114,
                'cat_title' => "罰金請求（寮費滞納）",
            ],
            [
                'cat_id' => 115,
                'cat_title' => "罰金請求（寮生大会欠席）",
            ],
            [
                'cat_id' => 116,
                'cat_title' => "罰金請求（委員会義務放棄）",
            ],
            [
                'cat_id' => 117,
                'cat_title' => "罰金請求（ブロック長義務放棄）",
            ],
            [
                'cat_id' => 199,
                'cat_title' => "その他の請求",
            ],
            [
                'cat_id' => 201,
                'cat_title' => "寮費支払（自動引落）",
            ],
            [
                'cat_id' => 202,
                'cat_title' => "寮費支払（現金払）",
            ],
            [
                'cat_id' => 211,
                'cat_title' => "委員会報酬（委員長）",
            ],
            [
                'cat_id' => 212,
                'cat_title' => "委員会報酬（副委員長）",
            ],
            [
                'cat_id' => 213,
                'cat_title' => "委員会報酬（総務）",
            ],
            [
                'cat_id' => 214,
                'cat_title' => "委員会報酬（会計委員）",
            ],
            [
                'cat_id' => 220,
                'cat_title' => "議長報酬",
            ],
            [
                'cat_id' => 221,
                'cat_title' => "クリーンデー報酬",
            ],
            [
                'cat_id' => 299,
                'cat_title' => "その他の報酬",
            ],
        ];

        foreach ($categories as $category) {
            DB::table('payment_categories')->insert($category);
        }
    }
}
