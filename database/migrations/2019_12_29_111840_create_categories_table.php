<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->string('type')->nullable(); //Receita | Despesa
            $table->timestamps();
        });

        \Artisan::call('db:seed', [
            '--class' => CategoryTableSeeder::class,
            '--force' => true
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \Schema::dropIfExists('categories');
    }
}
