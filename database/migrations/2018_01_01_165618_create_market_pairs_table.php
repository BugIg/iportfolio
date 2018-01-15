<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMarketPairsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('market_pairs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('market_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('coin_id');
            $table->timestamps();

            $table->unique(['currency_id', 'coin_id', 'market_id']);

            $table->index('market_id');
            $table->index('currency_id');
            $table->index('coin_id');


            $table->foreign('coin_id')
                ->references('id')->on('coins')
                ->onDelete('cascade');

            $table->foreign('market_id')
                ->references('id')->on('markets')
                ->onDelete('cascade');

            $table->foreign('currency_id')
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
        Schema::dropIfExists('market_pairs');
        Schema::enableForeignKeyConstraints();
    }
}
