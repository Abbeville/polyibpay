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
            $table->string('name');
            $table->string('fee');
            $table->string('amount');
            $table->string('required_label')->nullable();
            $table->string('item_code');
            $table->string('short_name');
            $table->string('biller_name')->nullable();

            $table->string('biller_id');
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
