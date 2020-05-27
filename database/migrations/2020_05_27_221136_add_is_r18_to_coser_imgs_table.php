<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIsR18ToCoserImgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->boolean('is_r18')->after('url')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coser_imgs', function (Blueprint $table) {
            $table->dropColumn('is_r18');
        });
    }
}
