<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('relations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
        });
        Schema::table('routes',function(Blueprint $table){
            $table->foreignId('monuments_id')->constrained()->nullable();
        });
        Schema::table('monuments',function(Blueprint $table){
            $table->foreignId('coordinates_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table){
            $table->dropForeign(['monuments_id']);
            $table->dropColumn('monuments_id');
        });
        Schema::table('monuments', function (Blueprint $table){
            $table->dropForeign(['coordinates_id']);
            $table->dropColumn('coordinates_id');
        });
        Schema::dropIfExists('relations');
    }
}
