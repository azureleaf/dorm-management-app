<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosingItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('closing_items', function (Blueprint $table) {
            $table->id();
            $table->integer("year");
            $table->integer("month");
            $table->string("abstract");
            $table->json("funds");
            $table->json("assets");
            $table->json("persons");
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
        Schema::dropIfExists('closing_items');
    }
}
