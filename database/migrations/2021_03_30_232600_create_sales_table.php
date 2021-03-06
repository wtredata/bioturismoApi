<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->date("date_start")->nullable();
            $table->date("date_end")->nullable();
            $table->text("description")->nullable();
            $table->text("data_client")->nullable();
            $table->double("price")->default(0);

            $table->unsignedBigInteger("state_sale_id");
            $table->unsignedBigInteger("user_id")->nullable();
            $table->timestamps();

            $table->foreign("state_sale_id")->references("id")->on("state_sales");
            $table->foreign("user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sales');
    }
}
