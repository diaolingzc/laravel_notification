<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImgToCoserImgsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->string('img')->after('url')->nullable($value = true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->dropColumn('img');
        });
    }
}
