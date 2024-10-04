<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TugasAkhir extends Model
{
    use HasFactory;
    protected $table = 'tugas_akhir';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_ta';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id');
    }

}
