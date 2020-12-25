<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankNamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_names', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('bank_name');
            $table->string('code');
            $table->string('slug');
            $table->string('status'); //It tells if the bank is active or not... TRUE or FALSE value ;
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
        Schema::dropIfExists('bank_names');
    }
}
