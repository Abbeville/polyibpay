<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_requests', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->unsignedBigInteger('transaction_id');
           $table->double('amount', 8, 8)->default(0)->comment('amount in crypto');
           $table->enum('type', ['btc', 'eth']);
           $table->string('proof_file')->nullable();
           $table->string('hash_code');
           $table->timestamps();
           $table->softDeletes();

           $table->foreign('transaction_id')->references('id')->on('transactions')
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
        Schema::dropIfExists('crypto_requests');
    }
}
