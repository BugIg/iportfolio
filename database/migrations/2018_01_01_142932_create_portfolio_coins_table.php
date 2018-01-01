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
            $table->uuid('coin_id')->index();
            $table->uuid('market_id')->index();
            $table->enum('type_trade', ['buy', 'sold'])->default('buy');
            $table->decimal('amount', 20, 8);
            $table->decimal('price', 20, 8);
            $table->dateTimeTz('time_trade');
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
        Schema::dropIfExists('portfolio_coins');
    }
}
