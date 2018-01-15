<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeCurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_currencies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('source_currency_id');
            $table->unsignedInteger('target_currency_id');
            $table->decimal('exchange_rate', 20, 8);
            $table->dateTimeTz('from_date');
            $table->dateTimeTz('to_date');
            $table->timestamps();

            $table->unique(['source_currency_id', 'target_currency_id', 'from_date', 'to_date']);

            $table->index('source_currency_id');
            $table->index('target_currency_id');
            $table->index('from_date');
            $table->index('to_date');

            $table->foreign('source_currency_id')
                ->references('id')->on('currencies')
                ->onDelete('cascade');

            $table->foreign('target_currency_id')
                ->references('id')->on('currencies')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('exchange_currencies');
        Schema::enableForeignKeyConstraints();
    }
}
