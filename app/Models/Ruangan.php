<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruangan';
    protected $guarded = [];


    public function gedung()
    {
      return $this->belongsTo(Gedung::class);
    }

    public function jenis_ruangan()
    {
      return $this->belongsTo(JenisRuangan::class);
    }
    
    public function alokasi()
    {
      return $this->hasMany(Alokasi::class,'ruangan_id');
    }




}
