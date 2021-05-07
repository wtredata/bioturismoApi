<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->text("description")->nullable();
            $table->boolean("active")->default(true);
            $table->double("price")->default(0);
            $table->string("time")->nullable();
            $table->integer("difficulty")->nullable();
            $table->string('photo')->nullable();

            $table->unsignedBigInteger("partner_id");
            $table->unsignedBigInteger("type_service_id");
            $table->timestamps();

            $table->foreign("partner_id")->references("id")->on("partners");
            $table->foreign("type_service_id")->references("id")->on("type_services");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('services');
    }
}
