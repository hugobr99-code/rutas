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
        Schema::table('monuments',function(Blueprint $table){
            $table->foreignId('routes_id')->constrained()->nullable();
        });
        Schema::table('coordinates',function(Blueprint $table){
            $table->foreignId('routes_id')->constrained()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('coordinates', function (Blueprint $table){
            $table->dropForeign(['routes_id']);
            $table->dropColumn('routes_id');
        });
        Schema::table('monuments', function (Blueprint $table){
            $table->dropForeign(['routes_id']);
            $table->dropColumn('routes_id');
        });
        Schema::dropIfExists('relations');
    }
}
