<?php

namespace App\DataTables;

use App\Models\Order;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class OrderDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'order.action')
            ->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn($data) => $data->updated_at->format('d-m-Y H:i:s'))
            ->editColumn('order_id', function ($data) {
                return "<a href='" . route('admin.order.show', $data->id) . "'>$data->order_id</a>";
            })
            ->editColumn('payment_status', function ($data) {
                if ($data->payment_status == 'paid') {
                    return "<span class='badge rounded-pill alert-success'>$data->payment_status</span>";
                } else {
                    return "<span class='badge rounded-pill alert-warning'>$data->payment_status</span>";
                }
            })
            ->editColumn('order_status', function ($data) {
                if ($data->order_status == 'confirmed') {
                    return "<span class='badge rounded-pill alert-success'>$data->order_status</span>";
                } else {
                    return "<span class='badge rounded-pill alert-warning'>$data->order_status</span>";
                }
            })
            ->addColumn('action', function ($data) {
                $buttonDelete = '';
                if (auth()->user()->can('delete order management')) {
                    $routeDelete = route('admin.order.destroy', $data->id);
                    $buttonDelete = "<a href='$routeDelete' class='btn btn-md font-sm bg-danger'>Delete</a>";
                }
                $element = "$buttonDelete";
                return $element;
            })
            ->rawColumns(['action', 'payment_status', 'order_status', 'order_id'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Order $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('banner-table')
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
            'order_id' => ['data' => 'order_id', 'name' => 'order_id', 'title' => 'Order ID'],
            'user.name' => ['data' => 'user.name', 'name' => 'user.name', 'title' => 'User Name'], // 'user.name' is the same as 'user->name
            'total' => ['data' => 'total', 'name' => 'total', 'title' => 'Total'],
            'payment_method' => ['data' => 'payment_method', 'name' => 'payment_method', 'title' => 'Payment Method'],
            'payment_status' => ['data' => 'payment_status', 'name' => 'payment_status', 'title' => 'Payment Status'],
            'order_status' => ['data' => 'order_status', 'name' => 'order_status', 'title' => 'Order Status'],
            'payment_id' => ['data' => 'payment_id', 'name' => 'payment_id', 'title' => 'Payment ID'],
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
        return 'Order_' . date('YmdHis');
    }
}
