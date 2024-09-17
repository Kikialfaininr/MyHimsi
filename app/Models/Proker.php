<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proker extends Model
{
    use HasFactory;
    protected $table = 'proker';
    protected $fillable = ['*'];
    protected $primaryKey = 'id_proker';
    public $timestamps = false;
   
    public function divisi()
    {
        return $this->belongsTo(Divisi::class, 'id_divisi');
    }
}
