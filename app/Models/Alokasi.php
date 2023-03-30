<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alokasi extends Model
{
    use HasFactory;
    protected $table      = 'alokasi';
    protected $guarded    = [];
    public $timestamps = false;


    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class,'ruangan_id');
    }
}
