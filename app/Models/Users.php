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

}
