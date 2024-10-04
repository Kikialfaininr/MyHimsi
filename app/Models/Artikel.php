<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;
    protected $table = 'artikel';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_artikel';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id');
    }

}
