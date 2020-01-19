<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->dateTime('date')->default(Carbon::create(2000, 1, 1, 0, 0, 0, 'Asia/Tokyo'));
            $table->integer('member_id')->references('id')->on('members');
            $table->integer('payment_category_id')->references('cat_id')->on('payment_categories')->default(199);
            $table->string('description');
            $table->integer('amount');
            $table->integer('balance');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
