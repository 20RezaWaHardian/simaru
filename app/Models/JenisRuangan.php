<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisRuangan extends Model
{
    use HasFactory;
    protected $table = 'jenis_ruangan';
    protected $guarded = [];

    public function ruangan()
    {
      return $this->hasMany(Ruangan::class);
    }
}
