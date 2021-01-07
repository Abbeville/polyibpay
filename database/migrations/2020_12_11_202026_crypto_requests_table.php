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
            $table->unsignedBigInteger('user_id');
            $table->string('request_id');
           $table->double('amount_crypto', 10, 8)->default(0)->comment('amount in crypto'); //eg 0.73637232
            $table->float('amount_usd');
            $table->float('amount_ngn');
            $table->float('current_rate');
            $table->enum('type', ['btc', 'eth']);
           $table->string('proof_file')->nullable();
           $table->string('hash_code')->nullable();
           $table->enum('status', ['pending', 'transferred', 'paid']);
           $table->timestamps();
           $table->softDeletes();



           $table->foreign('transaction_id')->references('id')->on('transactions')
                                ->onDelete('cascade')->onUpdate('cascade');
           $table->foreign('user_id')->references('id')->on('users')
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
