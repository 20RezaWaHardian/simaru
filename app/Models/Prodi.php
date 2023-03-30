<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    use HasFactory;
    protected $table      = 'siakad.prodi';
    protected $guarded    = [];
    protected $primaryKey = 'id_prodi';

    public function fakultas(){
        return $this->belongsTo(Fakultas::class,'id_fakultas');
    }

}
