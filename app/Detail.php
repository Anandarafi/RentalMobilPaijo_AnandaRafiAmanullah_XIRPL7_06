<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    protected $table ="detail_transaksi";
    protected $primarykey="id_detail";
    protected $fillable =[
        'id_detail',
        'id_peminjaman',
        'id_jenis',
        'peminjaman_hari',
        'total',

    ];
    public $timestamps = false;
}
