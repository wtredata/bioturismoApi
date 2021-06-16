<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ServiceTypeServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_type_experience', function (Blueprint $table) {

            $table->unsignedBigInteger("type_experience_id");
            $table->unsignedBigInteger("service_id");

            $table->foreign("type_experience_id")->references("id")->on("type_experiences");
            $table->foreign("service_id")->references("id")->on("services");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_type_experience');
    }
}
