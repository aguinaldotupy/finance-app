<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFileManagerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \Schema::create('file_manager', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->morphs('fileable');
            $table->string('type');
            $table->string('full_name');
            $table->string('name');
            $table->string('mime_type');
            $table->string('extension');
            $table->bigInteger('size');
            $table->string('path_storage');
            $table->string('disk');
            $table->string('visibility');
            $table->string('thumbnail')->nullable();
            $table->string('tags')->nullable(); //Any Field
            $table->text('observation')->nullable();
            $table->integer('order')->default(0); //Orderable by relevance
            $table->string('caption')->nullable(); //Title image for tag html
            $table->string('origem')->nullable(); //Route origin function
            $table->timestamp('true_timestamp')->nullable(); //Real time photo
            $table->timestamp('expiration_date')->nullable();
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
        \Schema::dropIfExists('file_manager');
    }
}
