<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    protected $table ="mobil";
    protected $primarykey="id_mobil";
    protected $fillable =[
        'id_mobil',
        'id_jenis',
        'nama_mobil',
        'platnomor',
    ];
    public $timestamps = false;
}
