<?php

namespace App\DataTables;

use App\Models\Role;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;

class RoleDataTable extends DataTable
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
            // ->editColumn('created_at', function($row){
            //     return $row->created_at->format('d-m-Y H:i:s');
            // })
            // ->editColumn('updated_at', function($row){
            //     return $row->updated_at->format('d-m-Y H:i:s');
            // })
            ->addColumn('action', function($row){
                    // $action = '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>' . '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye" style="color: white"></i></button>';
                $action = '';
                if(Gate::allows('update manajement/permissions')){

                    $action = '<button type="button" data-id='.$row->id.' data-jenis="set-permission" class="btn btn-info btn-sm action"> Permission </button>';
                    // $action .= ' <button type="button" data-id='.$row->id.' data-jenis="set-hak-akses" class="btn btn-success btn-sm action"> Hak Akses </button>';
                }
                if(Gate::allows('update manajement/roles')){

                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action"><i class="fas fa-pencil-alt"></i></button>';
                }

                if(Gate::allows('delete manajement/roles')){
                    $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
                }

                return $action;
            })
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Role $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model): QueryBuilder
    {
        // if(Auth::user()->hasRole('developer')){
            return $model->newQuery();
        // }else{
        //     return $model->whereNotIn('name', ['developer']);
        // }
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
                    ->setTableId('role-table')
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
            Column::make('id')->title('No')->searchable(false)->orederable(false)->width(40),
            Column::make('name'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(400)
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
        return 'Role_' . date('YmdHis');
    }
}
