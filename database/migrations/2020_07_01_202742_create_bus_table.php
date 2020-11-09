<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bus', function (Blueprint $table) {
            $table->id();
            $table->string('bu_name', '100');
            $table->integer('bu_rooms')->nullable();
            $table->integer('bu_price')->nullable();
            $table->tinyInteger('bu_rent')->nullable();
            $table->integer('bu_square')->nullable();
            $table->tinyInteger('bu_type')->nullable();
            $table->string('bu_small_dis', '160')->nullable();
            $table->string('bu_meta', '200')->nullable();
            $table->string('bu_longitude', '10')->nullable();
            $table->string('bu_Latitude', '10')->nullable();
            $table->longText('bu_large_dis')->nullable();
            $table->string('bu_place', '20')->nullable();
            $table->tinyInteger('bu_status')->nullable()->default(0);
            $table->integer('user_id');
            $table->string('image')->nullable();
            $table->string('month')->nullable();
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
        Schema::dropIfExists('bus');
    }
}
