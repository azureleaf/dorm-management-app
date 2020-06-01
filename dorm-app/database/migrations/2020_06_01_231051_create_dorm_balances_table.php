<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDormBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dorm_balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('fund_title_id')->constrained();
            $table->foreignId('personal_account_title_id')->constrained();
            $table->string("abstract");
            $table->integer("receipt");
            $table->integer("expense");
            $table->integer("balance");
            $table->string("comment");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('dorm_balances');
    }
}
