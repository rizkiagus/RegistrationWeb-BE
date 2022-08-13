<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berkas extends Model
{
    use HasFactory;

    protected $table = 'berkas';
    protected $fillable = [
        'tahun',
        'siswa_id',
        'nilai_skhun',
        'nilai_ijazah',
        'skhun_image',
        'ijazah_image',
    ];

    protected $hidden = [];

    protected function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
