<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Haki extends Model
{
    use HasFactory;
    protected $table = 'haki';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_haki';
    public $timestamps = false;

    public function users()
    {
        return $this->belongsTo(Users::class, 'id');
    }

}
