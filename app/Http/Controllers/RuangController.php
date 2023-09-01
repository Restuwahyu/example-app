<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ruangan;

class RuangController extends Controller
{
    //Fungsi Tampil Semua
    public function index()
    {
        $ruangan = Ruangan::all();
        if(is_null($ruangan)){
            return response([
                'message' => 'Tidak Ada Data Ruangan',
                'data' => null
            ], 404);//Return not found
        }else{
            return response([
                'message' => 'Berhasil Menampilkan Data Ruangan',
                'data' => $ruangan
            ], 200);
        }
    }

    //Fungsi Tampil Sesuai pencarian
    public function show($id_ruang){
        $ruangan = Ruangan::find($id_ruang);
        if(is_null($ruangan)){
            return response([
                'message' => 'Tidak Ada Data Ruangan',
                'data' => null
            ], 404);//Return Tidak Ada Data
        }else{
            return response([
                'message' => 'Berhasil Menampilkan Data Ruangan',
                'data' => $ruangan
            ], 200);
        }
    }

    //Fungsi Tambah Peminjaman
    public function store(Request $request){
        $storeData = $request->all();
        $validate = Validator::make($storeData, [
            'nama_ruang' => 'required',
            'deskripsi_ruang' => 'required',
            'kapasitas_ruang' => 'required',
            'status' => '',
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
            $ruangan = PeminjamanRuang::create([
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
    public function update(Request $request, $id_ruang){
        $ruangan = PeminjamanRuang::find($id_ruang);//Mencari Data Peminjaman

        if(is_null($ruangan)){
            return response([
                'message' => 'Tidak Dapat Menemukan Data Ruangan',
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
            $ruangan->nama_peminjam = $updateData['nama_peminjam'];
            $ruangan->id_ruang = $updateData['id_ruang'];
            $ruangan->tanggal_peminjam = $updateData['tanggal_peminjam'];
            $ruangan->waktu_mulai = $updateData['waktu_mulai'];
            $ruangan->waktu_selesai = $updateData['waktu_selesai'];
            $ruangan->keperluan_peminjam = $updateData['keperluan_peminjam'];

            if($ruangan->save()){
                return response([
                    'message' => 'Data Ruanganan Berhasil Diupdate',
                    'data' => $ruangan
                ],200);//Return Berhasil Update
            }else{
                return response([
                    'message' => 'Data Ruanganan Gagal Diupdate',
                    'data' => null
                ],400);//Return Gagal Update
            }
        }

    }

    //Fungsi Hapus Peminjaman
    public function destroy($id_ruang){
        $ruangan = Ruangan::find($id_ruang);//Mencari data Peminjaman
    
        if(is_null($ruangan)){
            return response([
                'message' => 'Data Ruanganan Tidak Ditemukan',
                'data' => null
            ], 404);
        }//Return Data Tidak Ada

        if($ruangan->delete()){
            return response([
                'message' => 'Data Ruanganan Berhasil Dihapus',
                'data' => $ruangan
            ], 200);//Return Berhasil Hapus
        }else{
            return response([
                'message' => 'Data Ruanganan Gagal Dihapus',
                'data' => null
            ], 400);
        } //Return Gagal Hapus 
    }
}