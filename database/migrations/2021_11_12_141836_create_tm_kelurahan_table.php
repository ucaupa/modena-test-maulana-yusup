<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmKelurahanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kecamatan_id')->index();
            $table->string('kelurahan');
            $table->integer('kd_pos');
            $table->timestamps();

            $table->foreign('kecamatan_id')->references('id')->on('tm_kecamatan')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_kelurahan');
    }
}
