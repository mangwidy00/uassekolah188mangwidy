<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Waliguru extends Model
{
    protected $table = 'waligurus';
    protected $primaryKey = 'id_waliguru';
    protected $fillable = ['nama_guru','nip','alamat','gender','no_telp'];
}
