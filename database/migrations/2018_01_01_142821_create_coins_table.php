<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoinsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coins', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 255);
            $table->string('code', 20)->unique();
            $table->unsignedTinyInteger('status')->default(1);;
            $table->smallInteger('rank');
            $table->char('logo_ext', 5)->nullable();
            $table->text('description')->nullable();
            $table->jsonb('details')->nullable();
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
        Schema::dropIfExists('coins');
    }
}
