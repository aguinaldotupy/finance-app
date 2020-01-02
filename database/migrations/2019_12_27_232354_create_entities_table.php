<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEntitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('entities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->timestamps();
        });

        \Artisan::call('db:seed', [
           '--class' => EntityTableSeeder::class,
           '--force' => true,
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('entities');
    }
}
