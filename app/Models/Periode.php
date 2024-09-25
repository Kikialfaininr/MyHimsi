<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periode extends Model
{
    use HasFactory;
    protected $table = 'periode';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_periode';
    public $timestamps = false;

    // Relasi Anggota
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_periode');
    }

    // Relasi Divisi
    public function divisi()
    {
        return $this->hasMany(Divisi::class, 'id_periode');
    }

    // Relasi Jabatan
    public function jabatan()
    {
        return $this->hasMany(Jabatan::class, 'id_periode');
    }

    // Relasi Proker
    public function proker()
    {
        return $this->hasMany(Proker::class, 'id_periode');
    }
}
