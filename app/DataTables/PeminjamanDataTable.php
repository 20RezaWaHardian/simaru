<?php

namespace App\DataTables;

use App\Models\Peminjaman;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;
use App\Helpers\MyHelpers;
use Illuminate\Support\Facades\Auth;

class PeminjamanDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     * @return \Yajra\DataTables\EloquentDataTable
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
        ->editColumn('tanggal_mulai_kegiatan', function($q){
            $tanggal_mulai = MyHelpers::tgl_indo($q->tanggal_mulai_kegiatan);
            return $tanggal_mulai;
        })
        ->editColumn('tanggal_selesai_kegiatan', function($q){
            $tanggal_selesai = MyHelpers::tgl_indo($q->tanggal_selesai_kegiatan);
            return $tanggal_selesai;
        })
        ->editColumn('waktu_mulai_kegiatan', function($q){
            $waktu_mulai = $q->waktu_mulai_kegiatan. ' WIB';
            return $waktu_mulai;
        })
        ->editColumn('waktu_selesai_kegiatan', function($q){
            $waktu_selesai = $q->waktu_selesai_kegiatan. ' WIB';
            return $waktu_selesai;
        })
        ->editColumn('status_peminjaman', function($row){

            if($row->status_peminjaman == 0){
                return "Diproses";
            }
            else if ($row->status_peminjaman == 1) {
                return "Divalidasi";
            }
            else if ($row->status_peminjaman == 2) {
                return "Ditolak";
            }
        })
        ->addColumn('action', function($row){
            $action = '';
            if(Gate::allows('accept manajement-ruangan/peminjaman')){
                if( Auth::user()->hasRole(['developer','admin','operator']) && $row->status_peminjaman == 0){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="accept" class="btn btn-success btn-sm action"><i class="fa fa-check" aria-hidden="true"></i></button>';
                }elseif(Auth::user()->hasRole('operator')){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="accept" class="btn btn-success btn-sm action"><i class="fa fa-check" aria-hidden="true"></i></button>';
                }
            }
            if(Gate::allows('disaccepting manajement-ruangan/peminjaman')){
                if(Auth::user()->hasRole(['developer','admin','operator']) && $row->status_peminjaman == 0 ){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="disaccept" class="btn btn-primary btn-sm action"><i class="fa fa-window-close" aria-hidden="true"></i></button>';
                }elseif(Auth::user()->hasRole('operator')){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="disaccept" class="btn btn-primary btn-sm action"><i class="fa fa-window-close" aria-hidden="true"></i></button>';
                }
            }
            if(Gate::allows('update manajement-ruangan/peminjaman')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="fas fa-pencil-alt"></i></button>';
            }
            if(Gate::allows('delete manajement-ruangan/peminjaman')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
            }

            return $action;
        })
        ->editColumn('ruangan_id', function($row){
            return $row->ruangan->nama_ruangan;
        })

        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Peminjaman $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Peminjaman $model): QueryBuilder
    {
        return $model->where('status_peminjaman',0)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('peminjaman-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     *
     * @return array
     */
    public function getColumns(): array
    {
        return [
            Column::make('peminjam_id')->title('NIP/NIK/NIDN'),
            Column::make('ruangan_id')->title('Nama Ruangan'),
            Column::make('nama_kegiatan'),
            Column::make('tanggal_mulai_kegiatan'),
            Column::make('waktu_mulai_kegiatan'),
            Column::make('tanggal_selesai_kegiatan'),
            Column::make('waktu_selesai_kegiatan'),
            Column::make('status_peminjaman'),
            Column::computed('action')
                    ->exportable(false)
                    ->printable(false)
                    ->width(150)
                    ->addClass('text-right'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Peminjaman_' . date('YmdHis');
    }
}
