<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jabatan extends Model
{
    use HasFactory;
    protected $table = 'jabatan';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_jabatan';
    public $timestamps = false;

    // Relasi ke Anggota
    public function anggota()
    {
        return $this->hasMany(Anggota::class, 'id_jabatan', 'id_jabatan');
    }

    public function periode()
    {
        return $this->belongsTo(Periode::class, 'id_periode');
    }
}
