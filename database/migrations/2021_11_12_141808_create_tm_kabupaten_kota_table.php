<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmKabupatenKotaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_kabupaten_kota', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provinsi_id')->index();
            $table->string('kabupaten_kota');
            $table->string('ibukota');
            $table->string('k_bsni');
            $table->timestamps();

            $table->foreign('provinsi_id')->references('id')->on('tm_provinsi')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_kabupaten_kota');
    }
}
