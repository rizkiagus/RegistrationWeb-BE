<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswas';
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'tgl_lahir',
        'tempat_lahir',
        'agama',
        'alamat',
        'email',
        'sekolah_asal',
        'pass_foto',
        'status_bayar',
        'telp',
        'jurusan',
        'tahun_ajaran'
    ];

    protected $hidden = [];

    protected function orangtua()
    {
        return $this->hasOne(Orangtua::class);
    }

    protected function berkas()
    {
        return $this->hasOne(Berkas::class);
    }
    protected function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }
}
