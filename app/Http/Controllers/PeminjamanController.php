<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Peminjaman;
use App\Detail;
use App\User;
use App\Jenis;
use Auth;
use DB;
use DateTime;

class PeminjamanController extends Controller
{
    //CEK LEVEL / POSISI PETUGAS
    public function cek(){
        if(Auth::user()->level=='admin'){
            $petugas=DB::table('petugas')->get();
            return response()->json($petugas);
        }else{
            return response()->json(['=== ANDA BUKAN ADMIN ===']);
        }
    }

    public function store(Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator = Validator::make($req->all(), 
        [
            'id_pelanggan'      => 'required',
            'id_petugas'        => 'required',
            'tgl_peminjaman'    => 'required',
            'tgl_pengembalian'  => 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $peminjaman = peminjaman::create([
            'id_pelanggan'      => $req->id_pelanggan,
            'id_petugas'        => $req->id_petugas,
            'tgl_peminjaman'    => $req->tgl_peminjaman,
            'tgl_pengembalian'  => $req->tgl_pengembalian,
        ]);
        if($peminjaman){
            return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY ADDED']);
        }
        else{
            return Response()->json(['status'=>false,'message'=>'DATA FAILED TO ADDED']);
            }
        }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator=Validator::make($req->all(),
        [
            'id_pelanggan'          => 'required',
            'id_petugas'            => 'required',
            'tgl_peminjaman'        => 'required',
            'tgl_pengembalian'      => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $peminjaman=peminjaman::where('id_peminjaman',$id)->update([
            'id_pelanggan'          => $req->id_pelanggan,
            'id_petugas'            => $req->id_petugas,
            'tgl_peminjaman'        => $req->tgl_peminjaman,
            'tgl_pengembalian'      => $req->tgl_pengembalian,
        ]);
        if($peminjaman){
            return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY CHANGED']);
        }
        else{
            return Response()->json(['status'=>false,'message'=>'DATA FAILED TO CHANGE']);
        }
    }
}

    public function delete($id)
    {
        if(Auth::user()->level=='admin'){
        $peminjaman=peminjaman::where('id_peminjaman',$id)->delete();
        if($peminjaman){
            return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY DELETED']);
        }
        else{
            return Response()->json(['status'=>false,'message'=>'DATA FAILED TO DELETED']);
        }
    }
    }
    public function tampil()
    {
        if(Auth::user()->level=='admin'){
            $peminjaman  =peminjaman::join('petugas','petugas.id','peminjaman.id_petugas')->join('pelanggan','pelanggan.id_pelanggan','peminjaman.id_pelanggan')->get();
            $arr_data=array();
            foreach ($peminjaman as $Peminjaman){
                $arr_data[]=array(
                    'id_peminjaman'=> $Peminjaman->id_peminjaman,
                    'id_petugas'=> $Peminjaman->id_petugas,
                    'nama_petugas'=> $Peminjaman->nama_petugas,
                    'id_pelanggan'=> $Peminjaman->id_pelanggan,
                    'nama'=> $Peminjaman->nama,
                    'tgl_peminjaman'=> $Peminjaman->tgl_peminjaman,
                    'tgl_pengembalian'=> $Peminjaman->tgl_pengembalian,
                );
                
            }
            return Response()->json([$arr_data]);
            }
}

public function store1(Request $req)
{

    $validator = Validator::make($req->all(), 
    [
        'id_peminjaman'      => 'required',
        'id_jenis'           => 'required',
    ]);

    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $hari = Peminjaman::where('id_peminjaman',$req->id_peminjaman)->first();
    $fdate = $hari->tgl_peminjaman;
    $tdate = $hari->tgl_pengembalian;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $berapa = $interval->format('%a');

    $total1 = Jenis::where('id_jenis',$req->id_jenis)->first();
    $total=$total1->harga_per_hari*$berapa;

    $detail = detail::create([
        'id_peminjaman'         => $req->id_peminjaman,
        'id_jenis'              => $req->id_jenis,
        'peminjaman_hari'       => $berapa,
        'total'                 => $total,
    ]);
    if($detail){
        return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY ADDED']);
    }
    else{
        return Response()->json(['status'=>false,'message'=>'DATA FAILED TO ADDED']);
        }

}

public function update1($id, Request $req)
{
    if(Auth::user()->level=='admin'){
    $validator=Validator::make($req->all(),
    [
        'id_peminjaman'      => 'required',
        'id_jenis'           => 'required',
    ]);
    if($validator->fails()){
        return Response()->json($validator->errors());
    }
    $hari = Peminjaman::where('id_peminjaman',$req->id_peminjaman)->first();
    $fdate = $hari->tgl_peminjaman;
    $tdate = $hari->tgl_pengembalian;
    $datetime1 = new DateTime($fdate);
    $datetime2 = new DateTime($tdate);
    $interval = $datetime1->diff($datetime2);
    $berapa = $interval->format('%a');

    $total1 = Jenis::where('id_jenis',$req->id_jenis)->first();
    $total=$req->harga_per_hari*$berapa;

    $detail=detail::where('id_detail',$id)->update([
        'id_peminjaman'         => $req->id_peminjaman,
        'id_jenis'              => $req->id_jenis,
        'peminjaman_hari'       => $berapa,
        'total'                 => $total,
    ]);
    if($detail){
        return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY CHANGED']);
    }
    else{
        return Response()->json(['status'=>false,'message'=>'DATA FAILED TO CHANGE']);
    }
}
}

public function delete1($id)
{
    if(Auth::user()->level=='admin'){
    $detail=detail::where('id_detail',$id)->delete();
    if($detail){
        return Response()->json(['status'=>true,'message'=>'DATA SUCCESSFULLY DELETED']);
    }
    else{
        return Response()->json(['status'=>false,'message'=>'DATA FAILED TO DELETED']);
    }
}
}
public function tampil1()
{
    if(Auth::user()->level=='admin'){
    $detail  =detail::join('jenis_mobil','jenis_mobil.id_jenis','detail_transaksi.id_jenis')->join('peminjaman','peminjaman.id_peminjaman','detail_transaksi.id_peminjaman')->join('mobil','mobil.id_jenis','jenis_mobil.id_jenis')->get();
    $arr_data=array();
    foreach ($detail as $Detail){
        $arr_data[]=array(
            'id_detail'=> $Detail->id_detail,
            'id_jenis'=> $Detail->id_jenis,
            'nama_jenis'=> $Detail->nama_jenis,
            'nama_mobil'=> $Detail->nama_mobil,
            'id_peminjaman'=> $Detail->id_peminjaman,
            'harga_per_hari'=> $Detail->harga_per_hari,
            'peminjaman_hari'=> $Detail->peminjaman_hari,
            'total'=> $Detail->total,
        );
    }
    return Response()->json([$arr_data]);
    }
}
}
