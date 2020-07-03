<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoserCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('coser_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->unsignedInteger('parent_id')->default(0);
            $table->boolean('is_r18')->default(0);
            $table->integer('topic_count')->default(0);
            $table->tinyInteger('is_directory');
            $table->unsignedInteger('level');
            $table->string('path');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('coser_categories');
    }
}
