<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sekolah extends Model
{
    protected $table = 'sekolahs';
    protected $primaryKey = 'id_sekolah';
    protected $fillable = ['nama_sekolah','lokasi_sekolah','id_siswa','id_waliguru','id_kelas'];

    public function Siswa()
    {
        return $this->belongsTo(Siswa::class, 'id_siswa');
    }
    public function Waliguru()
    {
        return $this->belongsTo(Waliguru::class, 'id_waliguru');
    }
    public function Kelas()
    {
        return $this->belongsTo(Kelas::class, 'id_kelas');
    }
}
