<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    use HasFactory;
    protected $table = 'divisi';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_divisi';
    public $timestamps = false;

    // Relasi ke Anggota
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_divisi', 'id_divisi');
    }

    // Relasi ke Proker
    public function proker()
    {
        return $this->hasMany(Proker::class, 'id_divisi', 'id_divisi');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
