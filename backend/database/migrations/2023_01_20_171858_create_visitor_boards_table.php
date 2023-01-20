<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorBoardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitor_boards', function (Blueprint $table) {
            $table->id();

            $table->integer("position");
            $table->unsignedBigInteger("visitor_id");
            $table->string("name");
            $table->enum("is_active",['Y','N']);

            $table->foreign("visitor_id")->references("id")->on("visitors")->onDelete("cascade");

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
        Schema::dropIfExists('visitor_boards');
    }
}
