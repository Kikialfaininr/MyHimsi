<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poster extends Model
{
    use HasFactory;
    protected $table = 'poster';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_poster';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id');
    }

}
