<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSiswasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('siswas', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 100);
            $table->string('jenis_kelamin', 15);
            $table->string('tgl_lahir', 20);
            $table->string('tempat_lahir', 50);
            $table->string('agama', 20);
            $table->string('alamat', 256);
            $table->string('sekolah_asal', 50);
            $table->longText('pass_foto');
            $table->string('status_bayar', 256);
            $table->string('telp', 15);
            $table->string('jurusan', 50);
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
        Schema::dropIfExists('siswas');
    }
}
