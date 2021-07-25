<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Kelas;
use Validator;

class KelasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'store', 'update', 'destroy']]);
    }
    public function index(){
        $kelas = Kelas::all();
        return response()->json($kelas);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'no_kelas' => 'required',
            'jurusan' => 'required',
            'jumlah_siswa' => 'required',
            'keterangan' => 'required'
        ]);
        if ($validate->passes()){

            $kelas = Kelas::create($request->all());
            return response()->json([
                'message' => 'Data Kelas Berhasil Disimpan',
                'data' => $kelas
            ]);
        }
        return response()->json([
            'message' => 'Data Kelas Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
     public function show($kelas)
    {
        $data = Kelas::where('id_kelas', $kelas)->first();
        if (!empty($data)) {
            return $data;
        }
        return response()->json(['message' => 'Data Kelas Tidak Ditemukan'], 404);
    }
    public function update(Request $request, $kelas)
    {
        $data = Kelas::where('id_kelas', $kelas)->first();
        if (!empty($data)) {
            $validate = Validator::make($request->all(), [
            'nama_kelas' => 'required',
            'no_kelas' => 'required',
            'jurusan' => 'required',
            'jumlah_siswa' => 'required',
            'keterangan' => 'required'
        ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Kelas Berhasil DiUpdate',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Data Kelas Gagal DiUpdate',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Kelas Tidak Ditemukan'
        ], 404);
    }
    public function destroy($kelas)
    {
        $data = Kelas::where('id_kelas', $kelas)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Kelas Tidak Ditemukan'
            ], 404);
        }
        
        $data->delete();
        return response()->json([
            'message' => 'Data Kelas Berhasil Dihapus'
        ], 200);
    }
}
