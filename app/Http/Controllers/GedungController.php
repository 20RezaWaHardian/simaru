<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\GedungDataTable;
use App\Models\Gedung;
use App\Models\Lokasi;

class gedungController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(GedungDataTable $dataTable)
    {

        if(Gate::allows('read master-data/gedung')){
            return $dataTable->render('master-data.gedung.index');
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
        if(Gate::allows('create master-data/gedung')){
            $data_lokasi = Lokasi::all();
            return view('master-data.gedung.gedung-action', ['gedung' => new Gedung(), 'data_lokasi' => $data_lokasi]);
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
            Gedung::create($request->all());
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
        if(Gate::allows('update master-data/gedung')){
            $gedung = Gedung::Find($id);
            $data_lokasi = Lokasi::all();
            return view('master-data.gedung.gedung-action',compact('gedung','data_lokasi'));
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
        if(Gate::allows('delete master-data/gedung')){
            try{
                $gedung = Gedung::findOrFail($id);
                $gedung->lokasi_id = $request->lokasi_id;
                $gedung->nama_gedung = $request->nama_gedung;
                $gedung->kode_gedung = $request->kode_gedung;
                $gedung->save();

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
        $gedung = Gedung::find($id);
        $gedung->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Data Success'
        ]);
    }
}
