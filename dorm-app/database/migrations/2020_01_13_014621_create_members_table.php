<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Carbon;

class CreateMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('members', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('last_name');
            $table->string('first_name');
            $table->string('last_name_reading');
            $table->string('first_name_reading');
            $table->boolean('is_living')->default(1);
            $table->integer('room')->nullable();
            $table->datetime('date_join')->default(Carbon::create(2000, 1, 1, 0, 0, 0, 'Asia/Tokyo'));
            $table->datetime('date_leave')->default(Carbon::create(2099, 12, 31, 23, 59, 59, 'Asia/Tokyo'));
            // $table->timestamps();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
}
