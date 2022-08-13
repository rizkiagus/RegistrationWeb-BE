<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orangtua extends Model
{
    use HasFactory;

    protected $table = 'orangtuas';
    protected $fillable = [
        'siswa_id',
        'nama',
        'alamat',
        'telp',
    ];

    protected $hidden = [];
    protected function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
