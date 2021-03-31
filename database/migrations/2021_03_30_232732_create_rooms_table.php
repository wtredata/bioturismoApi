<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->string('photo')->nullable();
            $table->string("description")->nullable();
            $table->boolean("active")->default(true);
            $table->double("price");
            $table->unsignedBigInteger("type_room_id");
            $table->timestamps();

            $table->foreign("type_room_id")->references("id")->on("type_rooms");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
