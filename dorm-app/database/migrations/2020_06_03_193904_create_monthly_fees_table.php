<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMonthlyFeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('monthly_fees', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->integer('month');
            $table->date('closed_at');
            $table->integer('total_amount');
            $table->integer('persons_before_deduction');
            $table->decimal('persons_after_deduction', 5, 2);
            $table->integer('fee_amount');
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
        Schema::dropIfExists('monthly_fees');
    }
}
