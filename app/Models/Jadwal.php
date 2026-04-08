<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Eskul;

class Jadwal extends Model
{
    protected $fillable = ['eskul_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function eskul()
    {
        return $this->belongsTo(Eskul::class);
    }
}
