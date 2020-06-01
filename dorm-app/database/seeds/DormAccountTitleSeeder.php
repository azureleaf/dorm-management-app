<?php

use Illuminate\Database\Seeder;
use App\DormAccountTitle;

class DormAccountTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $debitIn = new DormAccountTitle();
        $debitIn->name = "寮費引落納入";
        $debitIn->is_expense = false;
        $debitIn->save();

        $cashIn = new DormAccountTitle();
        $cashIn->name = "寮費現金納入";
        $cashIn->is_expense = false;
        $cashIn->save();

        $ex = new DormAccountTitle();
        $ex->name = "寮会計支出";
        $ex->is_expense = true;
        $ex->save();
    }
}
