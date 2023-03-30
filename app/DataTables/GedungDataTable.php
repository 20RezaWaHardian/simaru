<?php

namespace App\DataTables;

use App\Models\Gedung;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;


class GedungDataTable extends DataTable
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
            if(Gate::allows('update master-data/gedung')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="fas fa-pencil-alt"></i></button>';
            }

            if(Gate::allows('delete master-data/gedung')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
            }

            return $action;
        })
        ->editColumn('lokasi_id', function($row){
            return $row->lokasi->nama_lokasi;
        })
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Gedung $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Gedung $model): QueryBuilder
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
                    ->parameters(['searchDelay => 1000'])
                    ->setTableId('gedung-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            Column::make('nama_gedung'),
            Column::make('kode_gedung'),
            Column::make('lokasi_id')->title('Lokasi Gedung'),
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
        return 'Gedung_' . date('YmdHis');
    }
}
