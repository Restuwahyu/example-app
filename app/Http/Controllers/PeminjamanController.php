<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;

class PeminjamanController extends Controller
{
    //Fungsi Tampil Semua
    public function index()
    {
        $peminjamanRuangan = PeminjamanRuangan::all();
        if(is_null($peminjamanRuangan)){
            return response([
                'message' => 'Tidak Ada Data Peminjaman Ruang',
                'data' => null
            ], 404);//Return not found
        }else{
            return response([
                'message' => 'Berhasil Menampilkan Data Peminjaman Ruang',
                'data' => $peminjamanRuangan
            ], 200);
        }
    }

    //Fungsi Tampil Sesuai pencarian
    public function show($id_peminjam){
        $peminjamanRuangan = PeminjamanRuangan::find($id_peminjam);
        if(is_null($peminjamanRuangan)){
            return response([
                'message' => 'Tidak Ada Data Peminjaman Ruang',
                'data' => null
            ], 404);//Return Tidak Ada Data
        }else{
            return response([
                'message' => 'Berhasil Menampilkan Data Peminjaman Ruang',
                'data' => $peminjamanRuangan
            ], 200);
        }
    }

    //Fungsi Tambah Peminjaman
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_peminjam' => 'required',
            'id_ruang' => 'required',
            'tanggal_peminjam' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'keperluan_peminjam' => 'required',
        ]);

        //Membuat rule validasi input
        if(is_null($request->nama_peminjam)||
        is_null($request->id_ruang)||
        is_null($request->tanggal_peminjam)||
        is_null($request->waktu_mulai)||
        is_null($request->waktu_selesai||
        is_null($request->keperluan_peminjam))){
            return response(['message' => 'Inputan tidak boleh kosong'], 400);//Return input tidak boleh kosong
        }

        if($validate->fails()){
            return response(['message' => $validate->errors()],400);//Return error 
        }else{
            $peminjamanRuangan = PeminjamanRuang::create([
                'nama_peminjam'=> $request->nama_peminjam,
                'id_ruang'=> $request->id_ruang,
                'tanggal_peminjam'=> $request->tanggal_peminjam,
                'waktu_mulai'=> $request->waktu_mulai,
                'waktu_selesai'=> $request->waktu_selesai,
                'keperluan_peminjam'=> $request->keperluan_peminjam,
            ]); 
        }
    }

    //Fungsi Update Peminjaman
    public function update(Request $request, $id_peminjam){
        $peminjamanRuangan = PeminjamanRuang::find($id_peminjam);//Mencari Data Peminjaman

        if(is_null($peminjamanRuangan)){
            return response([
                'message' => 'Tidak Dapat Menemukan Data Peminjaman Ruang',
                'data' => null
            ],404);
        }//Return Data Tidak Ada

        $updateData = $request->all();
        $validate = Validator::make($updateData,[
            'nama_peminjam' => 'required',
            'id_ruang' => 'required',
            'tanggal_peminjam' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'keperluan_peminjam' => 'required',
        ]);

        //Membuat rule validasi input
        if(is_null($request->nama_peminjam)||
        is_null($request->id_ruang)||
        is_null($request->tanggal_peminjam)||
        is_null($request->waktu_mulai)||
        is_null($request->waktu_selesai||
        is_null($request->keperluan_peminjam))){
            return response(['message' => 'Inputan tidak boleh kosong'], 400);//Return input tidak boleh kosong
        }

        if($validate->fails()){
            return response(['message' => $validate->errors()],400);//Return error 
        }else{
            $peminjamanRuangan->nama_peminjam = $updateData['nama_peminjam'];
            $peminjamanRuangan->id_ruang = $updateData['id_ruang'];
            $peminjamanRuangan->tanggal_peminjam = $updateData['tanggal_peminjam'];
            $peminjamanRuangan->waktu_mulai = $updateData['waktu_mulai'];
            $peminjamanRuangan->waktu_selesai = $updateData['waktu_selesai'];
            $peminjamanRuangan->keperluan_peminjam = $updateData['keperluan_peminjam'];

            if($peminjamanRuangan->save()){
                return response([
                    'message' => 'Data Peminjaman Ruangan Berhasil Diupdate',
                    'data' => $peminjamanRuangan
                ],200);//Return Berhasil Update
            }else{
                return response([
                    'message' => 'Data Peminjaman Ruangan Gagal Diupdate',
                    'data' => null
                ],400);//Return Gagal Update
            }
        }

    }

    //Fungsi Hapus Peminjaman
    public function destroy($id_peminjam){
        $peminjamanRuangan = PeminjamanRuangan::find($id_peminjam);//Mencari data Peminjaman
    
        if(is_null($peminjamanRuangan)){
            return response([
                'message' => 'Data Peminjaman Ruangan Tidak Ditemukan',
                'data' => null
            ], 404);
        }//Return Data Tidak Ada

        if($peminjamanRuangan->delete()){
            return response([
                'message' => 'Data Peminjaman Ruangan Berhasil Dihapus',
                'data' => $peminjamanRuangan
            ], 200);//Return Berhasil Hapus
        }else{
            return response([
                'message' => 'Data Peminjaman Ruangan Gagal Dihapus',
                'data' => null
            ], 400);
        } //Return Gagal Hapus 
    }
}