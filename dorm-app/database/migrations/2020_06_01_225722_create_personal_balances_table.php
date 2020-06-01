<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalBalancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personal_balances', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer("year");
            $table->integer("month");
            $table->foreignId('personal_account_title_id')->constrained();
            $table->string("abstract");
            $table->integer("billing");
            $table->integer("payment");
            $table->json("billing_ids")->nullable();
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
        Schema::dropIfExists('personal_balances');
    }
}
