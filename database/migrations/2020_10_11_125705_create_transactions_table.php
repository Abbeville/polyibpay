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
            $table->enum('category', ['bill', 'wallet', 'vcard', 'airtime', 'data_bundle', 'crypto']);
            $table->string('reference');
            $table->double('amount', 16, 8);
            $table->text('narration');
            $table->enum('status', ['success', 'pending', 'failed', 'canceled']);
            $table->string('currency')->default('NG');
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
