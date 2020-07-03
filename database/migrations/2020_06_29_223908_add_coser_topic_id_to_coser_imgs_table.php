<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoserTopicIdToCoserImgsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->integer('coser_topic_id')->after('id')->unsigned()->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->dropColumn('coser_topic_id');
        });
    }
}
