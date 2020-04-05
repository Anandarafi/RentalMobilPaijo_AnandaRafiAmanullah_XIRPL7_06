<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Pelanggan;
use App\User;
use Auth;
use DB;

class PelangganController extends Controller
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
            'nama'      => 'required',
            'ktp'       => 'required',
            'alamat'    => 'required',
            'telp'      => 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $Pelanggan = Pelanggan::create([
            'nama'      => $req->nama,
            'ktp'       => $req->ktp,
            'alamat'    => $req->alamat,
            'telp'      => $req->telp,
        ]);
        if($Pelanggan){
            return Response()->json(['status'=>true,'message'=>'ANDA SUCCESSFULLY JOIN WITH US']);
        }
        else{
            return Response()->json(['status'=>false,'message'=>'ANDA FAILED TO JOIN WITH US']);
            }
        }
    }

    public function update($id, Request $req)
    {
        if(Auth::user()->level=='admin'){
        $validator=Validator::make($req->all(),
        [
            'nama'      => 'required',
            'ktp'       => 'required',
            'alamat'    => 'required',
            'telp'      => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $Pelanggan=Pelanggan::where('id_pelanggan',$id)->update([
            'nama'      => $req->nama,
            'ktp'       => $req->ktp,
            'alamat'    => $req->alamat,
            'telp'      => $req->telp,
        ]);
        if($Pelanggan){
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
        $Pelanggan=Pelanggan::where('id_pelanggan',$id)->delete();
        if($Pelanggan){
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
        $pelanggan=Pelanggan::all();
        $pelanggan = Pelanggan::count();
        if($Pelanggan){
            return Response()->json(['JUMLAH DATA'=>$pelanggan1,'DATA'=>$pelanggan,'status'=>true]);
        }
        else{
            return Response()->json(['status'=>false]);
        }
    }
}
}
