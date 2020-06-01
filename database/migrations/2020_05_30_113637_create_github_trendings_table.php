<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGithubTrendingsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('github_trendings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('author');
            $table->string('repository');
            $table->string('url');
            $table->string('language');
            $table->text('description');
            $table->text('description_translation')->nullable($value = true);
            $table->integer('star');
            $table->integer('fork');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('github_trendings');
    }
}
