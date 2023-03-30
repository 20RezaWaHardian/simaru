<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\PeminjamanDataTable;
use App\Models\Peminjaman;
use App\Models\Ruangan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\File; 

class PengajuanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PeminjamanDataTable $dataTable)
    {

        if(Gate::allows('read manajement-ruangan/peminjaman')){
            return $dataTable->render('manajement-ruangan.pengajuan.index');
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
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
    public function store(Request $request)
    {
        //
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
        if(Gate::allows('update manajement-ruangan/peminjaman')){
            $pengajuan = Peminjaman::Find($id);
            $data_ruangan   = Ruangan::where('status',1)->get();
            $data_peminjam  = DB::table('kepeg.pegawai')->where('status_keaktifan_pegawai_id',1)->get();
            $data_unit_pengguna = DB::table('kepeg.unit_kerja as a')
                            ->join('kepeg.referensi_unit_kerja as b', 'b.id_ref_unit_kerja','a.referensi_unit_kerja_id')
                            ->where('a.aktif',1)
                            ->get();
            return view('manajement-ruangan.pengajuan.pengajuan-action',compact('pengajuan','data_ruangan','data_peminjam','data_unit_pengguna'));
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
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
        $data = [
            'peminjam_id' => $request->peminjam_id,
            'ruangan_id' => $request->ruangan_id,
            'nama_kegiatan' => $request->nama_kegiatan,
            'estimasi_peserta' => $request->estimasi_peserta,
            'waktu_mulai_kegiatan' => $request->waktu_mulai_kegiatan,
            'waktu_selesai_kegiatan' => $request->waktu_selesai_kegiatan,
            'waktu_booking_peminjaman' => Carbon::now()->toDateTimeString(),
            'unit_pengguna' => $request->unit_pengguna,
            'penanggung_jawab_ruangan' => $request->penanggung_jawab_ruangan,
            'penanggung_jawab_pengguna' => $request->penanggung_jawab_pengguna,
            'keterangan' => $request->keterangan,
            'status_peminjaman' => 0,
        ];

        $dataPeminjaman = Peminjaman::find($id);
        // dd($dataPeminjaman->dokumen_peminjaman);
        $file = public_path("dokumen/peminjaman/{$dataPeminjaman->dokumen_peminjaman}");
        // dd($file);
        if($request->hasFile('dokumen_peminjaman')){

            if(File::exists($file))
            {
                // dd('oke');
                File::delete($file);
                
                $file = $request->file('dokumen_peminjaman');
                $nama_file = time()."_".$file->getClientOriginalExtension();
                $tujuan_upload = 'dokumen/peminjaman/';

                $file->move($tujuan_upload,$nama_file);
                $data['dokumen_peminjaman'] = $nama_file;
            }else{
                // dd('dsdaa');
                $file = $request->file('dokumen_peminjaman');
                $nama_file = time()."_".$file->getClientOriginalExtension();
                $tujuan_upload = 'dokumen/peminjaman/';

                $file->move($tujuan_upload,$nama_file);
                $data['dokumen_peminjaman'] = $nama_file;
            } 

            
            Peminjaman::where('id',$id)->update($data);

        }else{
            
            $data['dokumen_peminjaman'] = null;
            Peminjaman::where('id',$id)->update($data);
        }

        return redirect()->back()->with('success','Berhasil Mengubah Data Pengajuan Peminjaman!');
    }

    public function accept($id)
    {
        Peminjaman::where('id',$id)
            ->update([
                'status_peminjaman' => 1
            ]);
        
        return redirect()->back()->with('success','Berhasil Menerima Peminjaman!');
    }
    
    public function disaccept($id)
    {
        Peminjaman::where('id',$id)
            ->update([
                'status_peminjaman' => 2
            ]);
        
        return redirect()->back()->with('success','Berhasil Menolak Peminjaman!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Peminjaman::Find($id);
        $data->delete();

        return redirect()->back()->with('success','Berhasil Menghapus Data Pengajuan Peminjaman!');
    }
}
