<?php

namespace App\DataTables;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BrandDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'brand.action')
            ->editColumn('is_active', function ($data) {
                if ($data->is_active == 1) {
                    return "<span class='badge rounded-pill alert-success'>Active</span>";
                } else {
                    return "<span class='badge rounded-pill alert-warning'>Inactive</span>";
                }
            })
            ->editColumn('created_at', fn ($data) => $data->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn ($data) => $data->updated_at->format('d-m-Y H:i:s'))
            ->addColumn('action', function ($data) {
                $buttonEdit = '';
                $buttonDelete = '';
                if (auth()->user()->can('update brand management')) {
                    $routeEdit = route('admin.brand.edit', $data->id);
                    $buttonEdit = "<a href='$routeEdit' class='btn btn-primary btn-md'>Edit</a>";
                }
                if (auth()->user()->can('delete brand management')) {
                    $routeDelete = route('admin.brand.destroy', $data->id);
                    $buttonDelete = "<a href='$routeDelete' class='btn btn-md font-sm bg-danger'>Delete</a>";
                }
                $element = "$buttonEdit $buttonDelete";
                return $element;
            })
            ->rawColumns(['action', 'is_active'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Brand $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('brand-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('pdf'),
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            'id' => ['data' => 'id', 'name' => 'id', 'title' => 'ID'],
            'name' => ['data' => 'name', 'name' => 'name', 'title' => 'Name'],
            'slug' => ['data' => 'slug', 'name' => 'slug', 'title' => 'Slug'],
            'is_active' => ['data' => 'is_active', 'name' => 'is_active', 'title' => 'Status'],
            'created_at' => ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            'updated_at' => ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            'action' => ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Brand_' . date('YmdHis');
    }
}
