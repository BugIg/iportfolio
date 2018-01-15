<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePortfolioCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_coins', function (Blueprint $table) {
            $table->uuid('portfolio_id')->index();
            $table->unsignedInteger('coin_id');
            $table->unsignedInteger('currency_id');
            $table->unsignedInteger('market_id');
            $table->enum('type_trade', ['buy', 'sold'])->default('buy');
            $table->decimal('amount', 20, 8);
            $table->decimal('price', 20, 8);
            $table->dateTimeTz('time_trade');
            $table->timestamps();

            $table->index('currency_id');
            $table->index('coin_id');
            $table->index('market_id');

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
        Schema::dropIfExists('portfolio_coins');
        Schema::enableForeignKeyConstraints();
    }
}
