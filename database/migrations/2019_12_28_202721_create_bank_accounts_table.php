<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('bank_accounts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 120);
            $table->unsignedBigInteger('entity_id')->nullable();
            $table->unsignedBigInteger('owner_id');
            $table->float('balance', 8, 2)->default(0);
            $table->string('currency')->nullable();
            $table->timestamps();

            $table->foreign('entity_id')->references('id')->on('entities')->onDelete('SET NULL');
            $table->foreign('owner_id')->references('id')->on('users')->onDelete('cascade');
        });

        \Schema::create('bank_account_user', function (Blueprint $table) {
            $table->unsignedBigInteger('account_id');
            $table->unsignedBigInteger('user_id');

            $table->foreign('account_id')->references('id')->on('bank_accounts')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });

        \Artisan::call('db:seed', [
            '--class' => AccountsTableSeeder::class,
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
        \Schema::dropIfExists('bank_account_user');
        \Schema::dropIfExists('bank_accounts');
    }
}
