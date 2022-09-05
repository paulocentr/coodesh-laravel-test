<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConvertionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('convertions', function (Blueprint $table) {
            $table->id();
            $table->string('from')->default('BRL')->nullable();
            $table->string('to')->nullable();
            $table->string('payment_method')->nullable();
            $table->float('amount')->nullable();
            $table->float('tax_value')->nullable();
            $table->float('extra_tax_value')->nullable();
            $table->float('convertion_rate')->nullable();
            $table->float('total_converted_value')->nullable();
            $table->float('payment_tax')->nullable();
            $table->float('convertion_tax')->nullable();
            $table->float('discounted_amount')->nullable();
            $table->float('converted_discounted_amount')->nullable();
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
        Schema::dropIfExists('convertions');
    }
}
