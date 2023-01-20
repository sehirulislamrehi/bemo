<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorBoardCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_board_cards', function (Blueprint $table) {
            $table->id();

            $table->integer("position");
            $table->string("name");
            $table->text("description")->nullable();
            $table->unsignedBigInteger("visitor_board_id");

            $table->foreign("visitor_board_id")->references("id")->on("visitor_boards")->onDelete("cascade");

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
        Schema::dropIfExists('visitor_board_cards');
    }
}
