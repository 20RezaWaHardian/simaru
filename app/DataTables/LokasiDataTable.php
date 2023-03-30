<?php

namespace App\DataTables;

use App\Models\Lokasi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class LokasiDataTable extends DataTable
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
                if(Gate::allows('update master-data/lokasi')){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="fas fa-pencil-alt"></i></button>';
                }

                if(Gate::allows('delete master-data/lokasi')){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
                }

                return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Lokasi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Lokasi $model): QueryBuilder
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
                    ->setTableId('lokasi-table')
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
            Column::make('nama_lokasi'),
            Column::make('alamat_lokasi'),
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
        return 'Lokasi_' . date('YmdHis');
    }
}
