<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Waliguru;
use Validator;

class WaliguruController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'store', 'update', 'destroy']]);
    }
    public function index(){
        $waligurus = Waliguru::all();
        return response()->json($waligurus);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_guru' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
            'no_telp' => 'required'
        ]);
        if ($validate->passes()){

            $waligurus = Waliguru::create($request->all());
            return response()->json([
                'message' => 'Data Guru Berhasil Disimpan',
                'data' => $waligurus
            ]);
        }
        return response()->json([
            'message' => 'Data Guru Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($waligurus)
    {
        $data = Waliguru::where('id_waliguru', $waligurus)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data Guru tidak ditemukan'], 404);
    }
    public function update(Request $request, $waligurus)
    {
        $data = Waliguru::where('id_waliguru', $waligurus)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_guru' => 'required',
            'nip' => 'required',
            'alamat' => 'required',
            'gender' => 'required',
            'no_telp' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Guru Berhasil DiUpdate',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Guru Gagal DiUpdate',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Guru tidak ditemukan'
        ], 404);
    }
    public function destroy($waligurus)
    {
        $data = Waliguru::where('id_waliguru', $waligurus)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Guru Tidak Ditemukan'
            ], 404);
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Guru Berhasil Dihapus'
        ], 200);
    }
}
