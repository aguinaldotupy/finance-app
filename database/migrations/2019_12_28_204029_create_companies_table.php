<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('companies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('trading', 50)->nullable();
            $table->string('person_type', 10)->nullable();
            $table->string('number_social', 20)->unique();
            $table->string('business_type', 20)->nullable();
            $table->timestamps();
        });

        \Artisan::call('db:seed', [
            '--class' => CompanyTableSeeder::class,
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
        \Schema::dropIfExists('companies');
    }
}
