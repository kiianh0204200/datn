<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Services\DataTable;

class ProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'product.action')
            ->editColumn('is_active', function ($data) {
                if ($data->is_active == 1) {
                    return "<span class='badge rounded-pill alert-success'>Active</span>";
                } else {
                    return "<span class='badge rounded-pill alert-warning'>Inactive</span>";
                }
            })
            ->editColumn('name', function ($data) {
                $view = '';
                if (auth()->user()->can('read product management')) {
                    $view = "<a href='" . route('admin.product.show', $data->id) . "'>$data->name</a>";
                }
                return $view;
            })
            ->editColumn('thumbnail', function ($data) {
                $element = "<div class='col-lg-4 col-sm-4 col-8 flex-grow-1 col-name'>";
                $element .= "<a class='itemside' href='#'>";
                $element .= "<img src='$data->thumbnail_url' class='img-sm img-thumbnail' width='100px'>";
                $element .= "</a></div>";
                return $element;
            })
            ->editColumn('condition', function ($data) {
                if ($data->condition == 'new') {
                    return "<span class='badge rounded-pill alert-success'>New</span>";
                } elseif ($data->condition == 'hot') {
                    return "<span class='badge rounded-pill alert-warning'>Hot</span>";
                } else {
                    return "<span class='badge rounded-pill alert-danger'>Best Sale</span>";
                }
            })
            ->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn($data) => $data->updated_at->format('d-m-Y H:i:s'))
            ->addColumn('action', function ($data) {
                $buttonEdit = '';
                $buttonDelete = '';
                if (auth()->user()->can('update product management')) {
                    $routeEdit = route('admin.product.edit', $data->id);
                    $buttonEdit = "<a href='$routeEdit' class='btn btn-primary btn-md'>Edit</a>";
                }
                if (auth()->user()->can('delete product management')) {
                    $routeDelete = route('admin.product.destroy', $data->id);
                    $buttonDelete = "<a href='$routeDelete' class='btn btn-md font-sm bg-danger'>Delete</a>";
                }
                $element = "$buttonEdit $buttonDelete";
                return $element;
            })
            ->rawColumns(['action', 'is_active', 'thumbnail', 'condition', 'name'])
            ->setRowId(function ($row) {
                return 'row-' . $row->id;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('product-table')
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
            'thumbnail' => ['data' => 'thumbnail', 'name' => 'thumbnail', 'title' => 'Thumbnail'],
            'price' => ['data' => 'price', 'name' => 'price', 'title' => 'Price'],
            'discount' => ['data' => 'discount', 'name' => 'discount', 'title' => 'Discount'],
            'condition' => ['data' => 'condition', 'name' => 'condition', 'title' => 'Condition'],
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
        return 'Product_' . date('YmdHis');
    }
}
