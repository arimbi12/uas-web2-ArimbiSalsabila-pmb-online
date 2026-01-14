<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    protected $fillable = ['nim', 'nama', 'email', 'jurusan_id', 'foto'];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }
}