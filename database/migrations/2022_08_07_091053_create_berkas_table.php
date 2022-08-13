<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBerkasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('berkas', function (Blueprint $table) {
            $table->id('id');
            $table->string('siswa_id', 10);
            $table->string('nilai_skhun', 5);
            $table->string('nilai_ijazah', 5)->nullable();
            $table->string('tahun', 5);
            $table->longText('ijazah_image')->nullable();
            $table->longText('skhun_image');
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
        Schema::dropIfExists('berkas');
    }
}
