<?php

namespace App\DataTables;

use App\Models\Ruangan;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class RuanganDataTable extends DataTable
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
        ->addColumn('action', function($row){
            $action = '';
            if(Gate::allows('update master-data/ruangan')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="fas fa-pencil-alt"></i></button>';
            }

            if(Gate::allows('delete master-data/ruangan')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
            }

            return $action;
        })
        ->editColumn('gedung_id', function($row){
            return $row->gedung->nama_gedung . ' ( '.$row->gedung->kode_gedung.' ) ';
        })
        ->editColumn('jenis_ruangan_id', function($row){
            return $row->jenis_ruangan->nama_jenis;
        })
        ->editColumn('status', function($row){

            if ($row->status == 1) {
                return "Aktif";
            }
            else if ($row->status == 2) {
                return "Tidak Aktif";
            }
        })->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Ruangan $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Ruangan $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('ruangan-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('gedung_id')->title('Nama Gedung'),
            Column::make('nama_ruangan'),
            Column::make('kode_ruangan'),
            Column::make('kapasitas'),
            Column::make('status'),
            Column::make('jenis_ruangan_id')->title('Jenis Ruangan'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
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
        return 'Ruangan_' . date('YmdHis');
    }
}
