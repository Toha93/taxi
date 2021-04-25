<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('from_adr');
            $table->string('to_adr');
            $table->string('from_coord');
            $table->string('to_coord');
            $table->string('min_price');
            $table->string('price_km');
            $table->string('price_minuts');
            $table->string('final_price');
            $table->string('user_id');
            $table->string('status')->default('Новый');
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
        Schema::dropIfExists('orders');
    }
}
