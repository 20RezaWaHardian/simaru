<?php

namespace App\DataTables;

use App\Models\Prodi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class ProdiDataTable extends DataTable
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
        ->editColumn('id_fakultas', function($row){
            return $row->fakultas->nama_fakultas;
        })
        ->addColumn('action', function($row){
            // $action = '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>' . '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye" style="color: white"></i></button>';
            $action = '';
            if(Gate::allows('update manajement-ruangan/alokasi-ruangan')){
                $action .= '<a href="'.route('alokasi-ruangan.create', $row->id_prodi).'" class="btn btn-warning btn-sm action">Set Ruangan</a>';
            }
            return $action;
        })
        ->setRowId('id_prodi');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Prodi $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Prodi $model): QueryBuilder
    {
        $fakultasId = $this->request->get('fakultas_id');

        return Prodi::with('fakultas')->where('status',1)->where('id_prodi','!=',99995)->when($fakultasId, function ($query) use($fakultasId) {
            return $query->where('id_fakultas', $fakultasId);
        });

    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('prodi-table')
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
            Column::make('nama_prodi')->title('Program Studi'),
            Column::make('id_fakultas')->title('Fakultas'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(100)
                  ->addClass('text-center'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename(): string
    {
        return 'Prodi_' . date('YmdHis');
    }
}
