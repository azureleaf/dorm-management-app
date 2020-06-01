<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFundTitlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fund_titles', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string("name");
            $table->date("start_at")->nullable();
            $table->date("end_at")->nullable();
            $table->integer("monthly_reserve_amount")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fund_titles');
    }
}
