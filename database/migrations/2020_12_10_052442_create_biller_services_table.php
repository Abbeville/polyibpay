<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillerServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('biller_services', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('biller_code');
            $table->string('name');
            $table->boolean('is_airtime');
            $table->string('biller_name')->nullable();
            $table->double('fee', 16, 8);
            $table->string('label_name')->nullable();
            $table->double('amount', 16, 8);
            $table->string('item_code');
            $table->string('short_name');

            $table->unsignedBigInteger('biller_id');
            $table->json('meta_data')->nullable();

            $table->timestamps();

            $table->foreign('biller_id')->references('id')->on('billers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('biller_services');
    }
}
