<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PeminjamanRequest;
use App\Models\Ruangan;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Helpers\MyHelpers;


class PeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data_ruangan   = Ruangan::where('status',1)->get();
        $data_peminjam  = DB::table('kepeg.pegawai')->where('status_keaktifan_pegawai_id',1)->get();
        $data_unit_pengguna = DB::table('kepeg.unit_kerja as a')
                        ->join('kepeg.referensi_unit_kerja as b', 'b.id_ref_unit_kerja','a.referensi_unit_kerja_id')
                        ->where('a.aktif',1)
                        ->get();

        return view('manajement-ruangan.peminjaman.index',compact('data_ruangan','data_peminjam','data_unit_pengguna'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PeminjamanRequest $request)
    {
        $data = [
            'peminjam_id' => $request->peminjam_id,
            'ruangan_id' => $request->ruangan_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'estimasi_peserta' => $request->estimasi_peserta,
            'tanggal_mulai_kegiatan' => $request->tanggal_mulai_kegiatan,
            'tanggal_selesai_kegiatan' => $request->tanggal_selesai_kegiatan,
            'waktu_mulai_kegiatan' => $request->waktu_mulai_kegiatan,
            'waktu_selesai_kegiatan' => $request->waktu_selesai_kegiatan,
            'waktu_booking_peminjaman' => Carbon::now()->toDateTimeString(),
            'unit_pengguna' => $request->unit_pengguna,
            'penanggung_jawab_ruangan' => $request->penanggung_jawab_ruangan,
            'penanggung_jawab_pengguna' => $request->penanggung_jawab_pengguna,
            'keterangan' => $request->keterangan,
            'status_peminjaman' => 0,
        ];

        if($request->hasFile('dokumen_peminjaman')){
            $file = $request->file('dokumen_peminjaman');
            $nama_file = time()."_".$file->getClientOriginalExtension();
            $tujuan_upload = 'dokumen/peminjaman/';
            $file->move($tujuan_upload,$nama_file);

            $data['dokumen_peminjaman'] = $nama_file;
            Peminjaman::create($data);

        }else{
            $data['dokumen_peminjaman'] = null;
            Peminjaman::create($data);
        }

        return redirect()->back()->with('success','Berhasil Mengajukan Peminjaman!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
