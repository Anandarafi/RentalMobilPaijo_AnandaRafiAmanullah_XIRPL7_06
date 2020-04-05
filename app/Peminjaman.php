<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table ="peminjaman";
    protected $primarykey="id_peminjaman";
    protected $fillable =[
        'id_peminjaman',
        'id_pelanggan',
        'id_petugas',
        'tgl_peminjaman',
        'tgl_pengembalian',
    ];
    public $timestamps = false;
}
