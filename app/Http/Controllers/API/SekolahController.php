<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sekolah;
use Validator;

class SekolahController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['index', 'show', 'store', 'update', 'destroy']]);
    }
    public function index(){
        $sekolahs = Sekolah::with('Siswa', 'Waliguru', 'Kelas')->get();
        return response()->json($sekolahs);
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'nama_sekolah' => 'required',
            'lokasi_sekolah' => 'required',
            'id_siswa' => 'required',
            'id_waliguru' => 'required',
            'id_kelas' => 'required'
        ]);
        if($validate->passes()){
            $sekolahs = Sekolah::create($request->all());
            return response()->json([
                'message' => 'Data Sekolah Berhasil Disimpan',
                'data' => $sekolahs
            ]);
        }
        return response()->json([
            'message' => 'Data Sekolah Gagal Disimpan',
            'data' => $validate->error()->all()
        ]);
    }
    public function show($sekolahs)
    {
        $sekolahs = Sekolah::with('Siswa', 'Waliguru', 'Kelas')->where('id_sekolah', $sekolahs)->first();
        return response()->json($sekolahs);
    }
    public function update(Request $request, $sekolahs)
    {
        $data = Sekolah::where('id_sekolah', $sekolahs)->first();
        if (!empty($data)){
            $validate = Validator::make($request->all(), [
            'nama_sekolah' => 'required',
            'lokasi_sekolah' => 'required',
            'id_siswa' => 'required',
            'id_waliguru' => 'required',
            'id_kelas' => 'required'
            ]);
            if ($validate->passes()) {
                $data->update($request->all());
                return response()->json([
                    'message' => 'Data Sekolah Berhasil DiUpdate',
                    'data' => $data
                ], 200);
            }else{
                return response()->json([
                    'message' => 'Data Sekolah Gagal DiUpdate',
                    'data' => $validate->errors()->all()
                ]);
            }
        }
        return response()->json([
            'message' => 'Data Sekolah Tidak Ditemukan'
        ], 404);
    }
    public function destroy($sekolahs)
    {
        $data = Sekolah::where('id_sekolah', $sekolahs)->first();
        if (empty($data)) {
            return response()->json([
                'message' => 'Data Sekolah Tidak Ditemukan'
            ], 404);
        }
        $data->delete();
        return response()->json([
            'message' => 'Data Sekolah Berhasil Dihapus'
        ], 200);
    }
}
