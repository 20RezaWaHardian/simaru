<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    use HasFactory;
    protected $table = 'gedung';
    protected $guarded = [];


    public function lokasi()
    {
      return $this->belongsTo(Lokasi::class);
    }

    public function ruangan()
    {
      return $this->hasMany(Ruangan::class);
    }

}
