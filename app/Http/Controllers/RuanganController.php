<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\RuanganDataTable;
use App\Models\Ruangan;
use App\Models\JenisRuangan;
use App\Models\Gedung;

class ruanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(RuanganDataTable $dataTable)
    {

        if(Gate::allows('read master-data/ruangan')){
            return $dataTable->render('master-data.ruangan.index');
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
        if(Gate::allows('create master-data/ruangan')){
            $data_gedung = Gedung::all();
            $data_jenis_ruangan = JenisRuangan::all();
            return view('master-data.ruangan.ruangan-action', ['ruangan' => new ruangan(), 'data_gedung' => $data_gedung, 'data_jenis_ruangan' => $data_jenis_ruangan]);
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            Ruangan::create($request->all());
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
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
        if(Gate::allows('update master-data/ruangan')){
            $ruangan = Ruangan::Find($id);
            $data_gedung = Gedung::all();
            $data_jenis_ruangan = JenisRuangan::all();
            return view('master-data.ruangan.ruangan-action',compact('ruangan','data_gedung','data_jenis_ruangan'));
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
        if(Gate::allows('delete master-data/ruangan')){
            try{
                $ruangan = Ruangan::findOrFail($id);
                $ruangan->gedung_id = $request->gedung_id;
                $ruangan->nama_ruangan = $request->nama_ruangan;
                $ruangan->kode_ruangan = $request->kode_ruangan;
                $ruangan->kapasitas = $request->kapasitas;
                $ruangan->status = $request->status;
                $ruangan->jenis_ruangan_id = $request->jenis_ruangan_id;
                $ruangan->save();

            } catch (\Exception $e) {
                return redirect()->back()->with('error', $e->getMessage());
            }
        }else{
            abort(403,'Anda Tidak Memiliki Akses');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ruangan = Ruangan::find($id);
        $ruangan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Data Success'
        ]);
    }
}
