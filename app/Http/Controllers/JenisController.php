<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Jenis;
use App\User;
use Auth;
use DB;

class JenisController extends Controller
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
            'nama_jenis'      => 'required',
            'harga_per_hari'  => 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $jenis = jenis::create([
            'nama_jenis'      => $req->nama_jenis,
            'harga_per_hari'  => $req->harga_per_hari,
        ]);
        if($jenis){
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
            'nama_jenis'      => 'required',
            'harga_per_hari'  => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $jenis=jenis::where('id_jenis',$id)->update([
            'nama_jenis'      => $req->nama_jenis,
            'harga_per_hari'  => $req->harga_per_hari,
        ]);
        if($jenis){
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
        $jenis=jenis::where('id_jenis',$id)->delete();
        if($jenis){
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
        $jenis  =jenis::all();
        $jenis1  = jenis::count();
        if($jenis){
            return Response()->json(['JUMLAH DATA'=>$jenis1,'DATA'=>$jenis,'status'=>true]);
        }
        else{
            return Response()->json(['status'=>false]);
        }
    }
}
}
