<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;
use App\Models\DaftarEskul;

class Eskul extends Model
{
    protected $fillable = ['nama_eskul', 'pembina_id','no_hp','alamat', 'foto', 'deskripsi'];

    public function jadwals()
    {
        return $this->hasMany(Jadwal::class);
    }

    public function pembina()
{
    return $this->belongsTo(User::class, 'pembina_id');
}

public function daftars()
{
    return $this->hasMany(DaftarEskul::class, 'eskul_id');
}
}
