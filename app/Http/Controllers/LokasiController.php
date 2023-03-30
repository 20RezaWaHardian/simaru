<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\DataTables\LokasiDataTable;
use App\Models\Lokasi;

class LokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(LokasiDataTable $dataTable)
    {

        if(Gate::allows('read master-data/lokasi')){
            return $dataTable->render('master-data.lokasi.index');
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
        if(Gate::allows('create master-data/lokasi')){
            return view('master-data.lokasi.lokasi-action', ['lokasi' => new Lokasi()]);
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
            Lokasi::create($request->all());
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
        if(Gate::allows('update master-data/lokasi')){
            $lokasi = Lokasi::Find($id);
            return view('master-data.lokasi.lokasi-action',compact('lokasi'));
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
        if(Gate::allows('delete master-data/lokasi')){
            try{
                $lokasi = Lokasi::findOrFail($id);
                $lokasi->nama_lokasi = $request->nama_lokasi;
                $lokasi->alamat_lokasi = $request->alamat_lokasi;
                $lokasi->save();

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
        $lokasi = Lokasi::find($id);
        $lokasi->delete();
        return response()->json([
            'status' => 'success',
            'message' => 'Delete Data Success'
        ]);
    }
}
