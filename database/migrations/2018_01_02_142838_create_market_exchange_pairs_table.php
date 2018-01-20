<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketExchangePairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_exchange_pairs', function (Blueprint $table) {

            $table->increments('id');
            $table->unsignedInteger('market_pair_id');
            $table->decimal('exchange_rate', 20, 8);
            $table->dateTimeTz('from_date');
            $table->dateTimeTz('to_date');
            $table->decimal('change', 5, 2);
            $table->decimal('volume_24hours', 20, 8);
            $table->jsonb('order_book')->nullable();
            $table->timestamps();

            $table->unique(['market_pair_id', 'from_date', 'to_date']);

            $table->index('market_pair_id');
            $table->index('from_date');
            $table->index('to_date');

            $table->foreign('market_pair_id')
                ->references('id')->on('market_pairs')
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
        Schema::dropIfExists('market_exchange_pairs');
        Schema::enableForeignKeyConstraints();
    }
}
