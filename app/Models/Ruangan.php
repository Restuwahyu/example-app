<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ruangan extends Model
{
    use HasFactory;
    protected $table = 'ruang';
    protected $primaryKey = 'id_ruang';
    public $timestamps = false;

    protected $fillable = ['nama_ruang', 'deskripsi_ruang', 'kapasitas_ruang', 'status'];
}