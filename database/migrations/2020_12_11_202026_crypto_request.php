<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CryptoRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('crypto_request', function (Blueprint $table){
           $table->bigIncrements('id');
           $table->string('user_id');
           $table->string('amount')->comment('amount in crypto');
           $table->enum('type', ['btc', 'eth']);
           $table->enum('status', ['pending', 'active', 'rejected', 'cancelled', 'completed'])->default('pending');
           $table->string('proof_file')->nullable();
           $table->string('hash_code');
           $table->timestamps();
           $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
