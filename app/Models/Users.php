<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $fillable = ['*'];
    protected $primaryKey = 'id';
    public $timestamps = false;

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'id_anggota');
    }

    public function artikel()
    {
        return $this->hasMany(Artikel::class, 'id');
    }

    public function haki()
    {
        return $this->hasMany(Haki::class, 'id');
    }
    
    public function tugasakhir()
    {
        return $this->hasMany(TugasAkhir::class, 'id');
    }

    public function poster()
    {
        return $this->hasMany(Poster::class, 'id');
    }

}
