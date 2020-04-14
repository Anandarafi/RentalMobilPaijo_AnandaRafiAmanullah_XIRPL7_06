<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Mobil;
use App\User;
use Auth;
use DB;

class MobilController extends Controller
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
            'id_jenis'      => 'required',
            'nama_mobil'    => 'required',
            'platnomor'     => 'required',
        ]);

        if($validator->fails()){
            return Response()->json($validator->errors());
        }

        $mobil = mobil::create([
            'id_jenis'      => $req->id_jenis,
            'nama_mobil'    => $req->nama_mobil,
            'platnomor'     => $req->platnomor,
        ]);
        if($mobil){
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
            'id_jenis'      => 'required',
            'nama_mobil'    => 'required',
            'platnomor'     => 'required',
        ]);
        if($validator->fails()){
            return Response()->json($validator->errors());
        }
        $mobil=mobil::where('id_mobil',$id)->update([
            'id_jenis'      => $req->id_jenis,
            'nama_mobil'    => $req->nama_mobil,
            'platnomor'     => $req->platnomor,
        ]);
        if($mobil){
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
        $mobil=mobil::where('id_mobil',$id)->delete();
        if($mobil){
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
        $mobil  =mobil::all();
        $mobil1 = mobil::count();
        if($mobil){
            return Response()->json(['JUMLAH DATA'=>$mobil1,'DATA'=>$mobil,'status'=>true]);
        }
        else{
            return Response()->json(['status'=>false]);
        }
    }
}
}
