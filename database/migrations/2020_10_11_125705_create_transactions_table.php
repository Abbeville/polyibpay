<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->enum('type', ['credit', 'debit']);
            $table->enum('occurred_on', ['wallet', 'vcard']);
            // $table->enum('category', ['bill', 'wallet', 'vcard', 'airtime', 'data bundle', 'crypto']);
            $table->enum('category', ['bill', 'top_up','crypto']);
            $table->string('reference');
            $table->double('amount', 16, 8);
            $table->text('narration');
            $table->string('currency')->nullable()->default('NGN');
            $table->enum('status', ['success', 'pending', 'failed', 'canceled'])->default('pending');
            $table->string('chargecode')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
