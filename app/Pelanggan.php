<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table ="pelanggan";
    protected $primarykey="id_pelanggan";
    protected $fillable =[
        'id_pelanggan',
        'nama',
        'ktp',
        'alamat',
        'telp',
    ];
    public $timestamps = false;
}
