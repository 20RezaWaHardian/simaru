<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\DataTables\ProdiDataTable;
use App\Models\Ruangan;
use App\Models\Prodi;
use App\Models\Fakultas;
use App\Models\Alokasi;

class AlokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(ProdiDataTable $dataTable)
    {
        $fakultas = Fakultas::where('status',1)->get();
        $prodi = Prodi::where('status',1)->where('id_prodi','!=',99995)->count();

        return $dataTable->render('manajement-ruangan.alokasi-ruangan.index',compact('fakultas','prodi'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

       $data_ruangan = Ruangan::whereIn('jenis_ruangan_id',[2,3])->where('status',1)->get();
       $prodi = Prodi::findorfail($id);

       return view('manajement-ruangan.alokasi-ruangan.create',compact('data_ruangan','prodi'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $id_prodi = decrypt($request->secret);
        $id_ruangan = decrypt($request->ruangan_id);
        Alokasi::create([
            'ruangan_id' => $id_ruangan,
            'prodi_id' => $id_prodi,
            'hari' => $request->hari,
            'j6' => $request->j6,
            'j7' => $request->j7,
            'j8' => $request->j8,
            'j9' => $request->j9,
            'j10' => $request->j10,
            'j11' => $request->j11,
            'j12' => $request->j12,
            'j13' => $request->j13,
            'j14' => $request->j14,
            'j15' => $request->j15,
            'j16' => $request->j16,
            'j17' => $request->j17,
            'j18' => $request->j18,
            'j19' => $request->j19,
            'j20' => $request->j20,
            'j21' => $request->j21,
            'j22' => $request->j22,
            'j23' => $request->j23,
        ]);

        return redirect()->back()->with('success','Data Berhasil di Alokasikan!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $header = ['Ruangan','Hari','06','07','08','09','10','11','12','13','14','15','16','17','18','19','20','21','22','23','Action'];
        $data_hari=array(
            1 => "Senin",
            2 => "Selasa",
            3 => "Rabu",
            4 => "Kamis",
            5 => "Jum'at",
            6 => "Sabtu",
            );

        $data_alokasi = Alokasi::where('prodi_id',$id)->get();


        //Data Modal
        $data_ruangan = Ruangan::whereIn('jenis_ruangan_id',[2,3])->where('status',1)->get();

        $prodi = Prodi::findorfail($id);



        return view('manajement-ruangan.alokasi-ruangan.show',compact('header','data_hari','data_alokasi','data_ruangan','prodi'));
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
