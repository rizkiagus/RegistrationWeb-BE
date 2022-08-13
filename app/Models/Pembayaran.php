<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    protected $fillable = [
        'id_siswa',
        'jumlah',
    ];

    protected $hidden = [];
    protected function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }
}
