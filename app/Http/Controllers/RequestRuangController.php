<?php

namespace App\Http\Controllers;

use App\Models\RequestRuang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestRuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = DB::table('request_ruang')
                ->leftJoin('users', 'users.id', '=', 'request_ruang.id_divisi')
                ->leftJoin('ruang_rapat', 'ruang_rapat.id', '=', 'request_ruang.id_ruang')
                ->orderBy('id', 'DESC')
                ->select('request_ruang.*', 'users.name as divisi', 'ruang_rapat.nama_ruang as ruang')
                ->get();

        $ruang = DB::table('ruang_rapat')->get();

        return view('request_ruang', ['data' => $data, 'ruang' => $ruang]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        DB::table('request_ruang')->insert([
            'id_divisi'         => auth()->user()->id,
            'id_ruang'          => $req->nama_ruang,
            'tanggal_request'   => date('Y-m-d'),
            'tanggal_rapat'     => $req->tanggal_rapat,
            'waktu_mulai'       => $req->waktu_mulai,
            'waktu_selesai'     => $req->waktu_selesai,
            'deskripsi_rapat'   => $req->deskripsi_rapat,
            'status_verifikasi' => 0,
        ]);

        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $req)
    {
        DB::table('request_ruang')->where('id', $req->id)->update([
            'status_verifikasi' => $req->status_verifikasi,
            'keterangan_verifikasi' => $req->keterangan_verifikasi,
        ]);

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RequestRuang $requestRuang)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RequestRuang $requestRuang)
    {
        //
    }
}
