<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTmKecamatanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tm_kecamatan', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kabkot_id')->index();
            $table->string('kecamatan');
            $table->timestamps();

            $table->foreign('kabkot_id')->references('id')->on('tm_kabupaten_kota')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tm_kecamatan');
    }
}
