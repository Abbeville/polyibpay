<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBillInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_infos', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('biller_id');
            $table->unsignedBigInteger('biller_service');
            $table->unsignedBigInteger('service_category');

            $table->timestamps();


            $table->foreign('transaction_id')->references('id')->on('transactions')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('biller_id')->references('id')->on('billers')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('biller_service')->references('id')->on('biller_services')
                                        ->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('service_category')->references('id')->on('service_categories')
                                        ->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_infos');
    }
}
