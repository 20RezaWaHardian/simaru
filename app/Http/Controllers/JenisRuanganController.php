<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\JenisRuanganDataTable;
use App\Models\JenisRuangan;

class JenisRuanganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JenisRuanganDataTable $dataTable)
    {

        if(Gate::allows('read master-data/jenis-ruangan')){
            return $dataTable->render('master-data.jenis-ruangan.index');
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
        if(Gate::allows('create master-data/jenis-ruangan')){
            return view('master-data.jenis-ruangan.jenis-ruangan-action', ['jenis_ruangan' => new JenisRuangan()]);
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
            JenisRuangan::create($request->all());
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
        if(Gate::allows('update master-data/jenis-ruangan')){
            $jenis_ruangan = JenisRuangan::Find($id);
            return view('master-data.jenis-ruangan.jenis-ruangan-action',compact('jenis_ruangan'));
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
        if(Gate::allows('delete master-data/jenis-ruangan')){
            try{
                $jenis_ruangan = JenisRuangan::findOrFail($id);
                $jenis_ruangan->nama_jenis = $request->nama_jenis;
                $jenis_ruangan->save();

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
        $jenis_ruangan = JenisRuangan::find($id);
        $jenis_ruangan->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Data Success'
        ]);
    }
}
