<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PeminjamanRuangan extends Model
{
    use HasFactory;
    protected $table = 'peminjaman';
    protected $primaryKey = 'id_peminjam';
    public $timestamps = false;

    protected $fillable = ['nama_peminjam', 'tanggal_peminjam', 'waktu_mulai','waktu_selesai','keperluan_peminjam'];

    public function ruangan()
    {
        return $this->belongsTo(Ruangan::class, 'id_ruang', 'id_ruang');
    }
}