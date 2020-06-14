<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date("closed_at");
            $table->date("paid_at")->nullable();
            $table->foreignId('user_id')->constrained();
            $table->integer("amount");
            $table->integer("year");
            $table->integer("month");
            // $table->boolean("is_next_debit_target")->nullable();
            // $table->boolean("is_cash_payment")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billings');
    }
}
