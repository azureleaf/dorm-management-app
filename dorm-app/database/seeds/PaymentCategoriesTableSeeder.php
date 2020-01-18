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
        $categories = [[
            'cat_id' => 100,
            'cat_title' => "基本金請求",
        ], [
            'cat_id' => 101,
            'cat_title' => "罰金請求（風呂掃除）",
        ], [
            'cat_id' => 102,
            'cat_title' => "罰金請求（ブロック清掃）",
        ], [
            'cat_id' => 103,
            'cat_title' => "罰金請求（寮費滞納）",
        ], [
            'cat_id' => 104,
            'cat_title' => "罰金請求（寮生大会欠席）",
        ], [
            'cat_id' => 105,
            'cat_title' => "罰金請求（委員会義務放棄）",
        ], [
            'cat_id' => 199,
            'cat_title' => "その他の請求",
        ], [
            'cat_id' => 201,
            'cat_title' => "委員会報酬（委員長）",
        ], [
            'cat_id' => 202,
            'cat_title' => "委員会報酬（副委員長）",
        ], [
            'cat_id' => 203,
            'cat_title' => "委員会報酬（総務）",
        ], [
            'cat_id' => 204,
            'cat_title' => "委員会報酬（会計委員）",
        ], [
            'cat_id' => 210,
            'cat_title' => "議長報酬",
        ],
        ];

        foreach ($categories as $category) {
            DB::table('payment_categories')->insert($category);
        }
    }
}
