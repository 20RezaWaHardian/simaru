<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use Auth;

class UserDataTable extends DataTable
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
     
        ->addColumn('role', function(User $user) {
           $awal =  json_decode($user->getRoleNames());
        //    $role =  preg_replace('/[^A-Za-z0-9\]/', '', $user->getRoleNames());
        //    $role = Str::of($awal)->replace(',','-');
        $role = implode(" || ", $awal);
           return $role;
            
        })

        ->addColumn('action', function($row){
                // $action = '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-pencil-alt"></i></button>' . '<button type="button" class="btn btn-primary btn-sm"><i class="fas fa-eye" style="color: white"></i></button>';
            $action = '';
            if(Gate::allows('update manajement/users')){
                $action = '<button type="button" data-id='.$row->id.' data-jenis="edit" class="btn btn-warning btn-sm action">Set Role</button>';
            }
            if(Gate::allows('delete manajement/users')){
                $action .= ' <button type="button" data-id='.$row->id.' data-jenis="delete" class="btn btn-danger btn-sm action"><i class="fas fa-trash"></i></button>';
            }

            return $action;
        })
        ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model): QueryBuilder
    {

        // $model->except($model->hasRole('developer'));
        // if(Auth::user()->hasRole('developer')){
            return $model->newQuery();
        // }else{
        //     return $model->where('usertype','!=','developer');
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
                    ->setTableId('user-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    // ->dom('Bfrtip')
                    // ->orderBy(1)
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
            // Column::make('DT_RowIndex')->title('No'),
            // Column::make('id')->removeColumn('id'),
            Column::make('name'),
            Column::make('username')->title('NIP'),
            Column::computed('role'),
    
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
        return 'User_' . date('YmdHis');
    }
}
