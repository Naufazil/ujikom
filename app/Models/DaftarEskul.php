<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Models\Eskul;
use App\Models\Penerimaan;

class DaftarEskul extends Model
{
    use HasFactory;

    protected $table = 'daftar__eskuls';

    protected $fillable = ['user_id','kelas','eskul_id','tahun_ajaran','no_telp','alasan', 'status', ];

    // Relasi ke user (siswa yang daftar)
   public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

public function eskul()
{
    return $this->belongsTo(Eskul::class, 'eskul_id');
}

    // Relasi ke data penerimaan (1:1)
    public function penerimaan()
    {
        return $this->hasOne(Penerimaan::class, 'daftar_id');
    }
}

const STATUS_MENUNGGU = 'menunggu';
const STATUS_DITERIMA = 'diterima';
const STATUS_DITOLAK = 'ditolak';
