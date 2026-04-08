<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\DaftarEskul;

class Penerimaan extends Model
{
    protected $fillable = ['daftar_id', 'catatan'];

    public function daftar()
    {
        return $this->belongsTo(DaftarEskul::class, 'daftar_id');
    }
}
