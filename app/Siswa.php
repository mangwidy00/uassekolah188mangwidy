<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswas';
    protected $primaryKey = 'id_siswa';
    protected $fillable = ['nama_siswa','kelas','ttl_siswa','umur','alamat'];
}
