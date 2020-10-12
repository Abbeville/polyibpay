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
            $table->bigIncrements('id');

            $table->string('name');
            $table->string('banner_url')->nullable();
            $table->string('fee');
            $table->string('amount');
            $table->string('required_label');
            $table->string('item_code');
            $table->string('short_name');
            $table->string('biller_name');

            $table->unsignedBigInteger('category_id');

            $table->json('meta_data');
            $table->timestamps();

            $table->foreign('category_id')->references('id')->on('service_categories');


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
