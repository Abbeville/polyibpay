<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVirtualCardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('virtual_cards', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('card_id');
            $table->unsignedBigInteger('account_id');
            $table->double('credits', 16, 8)->default(0);
            $table->double('debits', 16, 8)->default(0);
            $table->double('balance', 16, 8)->default(0);
            $table->string('name_on_card');
            $table->string('expiration');
            $table->integer('cvv');
            $table->boolean('is_active')->default(1)->comment('Tells if it has been disabled or not');
            $table->string('card_pan')->comment('The Card Number of 15 digits or so');
            $table->string('masked_pan')->comment('The Card Number that is not written completely');
            $table->string('card_type')->comment('It tells if card is master, visa or verve');
            $table->string('billing_address');
            $table->string('billing_country');
            $table->string('billing_state');
            $table->string('billing_city');
            $table->string('billing_zip_code');
            $table->enum('currency_type', ['NGN', 'USD'])->default('NGN');

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
        Schema::dropIfExists('virtual_cards');
    }
}
