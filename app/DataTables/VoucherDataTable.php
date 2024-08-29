<?php

namespace App\DataTables;

use App\Models\Voucher;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VoucherDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'voucher.action')
            ->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn($data) => $data->updated_at->format('d-m-Y H:i:s'))
            ->editColumn('status', function ($data) {
                return $data->status 
                    ? "<span class='badge rounded-pill alert-success'>Active</span>" 
                    : "<span class='badge rounded-pill alert-warning'>Inactive</span>";
            })
            ->editColumn('discount_type', function ($data) {
                return $data->status 
                    ? "tiền" 
                    : "phàn trăm";
            })
            ->editColumn('description', function ($data) {
                return strip_tags($data->description, '<p><br>'); // Cho phép các thẻ HTML như <p> và <br>
            })
            ->addColumn('action', function ($data) {
                $buttonEdit = '';
                $buttonDelete = '';
                if (auth()->user()->can('update voucher management')) {
                    $routeEdit = route('admin.voucher.edit', $data->id);
                    $buttonEdit = "<a href='$routeEdit' class='btn btn-primary btn-md'>Edit</a>";
                }

                if (auth()->user()->can('delete voucher management')) {
                    $routeDelete = route('admin.voucher.destroy', $data->id);
                    $buttonDelete = "<a href='$routeDelete' class='btn btn-md font-sm bg-danger'>Delete</a>";
                }
                return "$buttonEdit $buttonDelete";
            })
            ->rawColumns(['action', 'status', 'description']) 
            ->setRowId(function ($row) {
                return 'row-' . $row->id;
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Voucher $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('voucher-table')
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
            'code' => ['data' => 'code', 'name' => 'code', 'title' => 'Voucher Mã'],
            'description' => ['data' => 'description', 'name' => 'description', 'title' => 'Mô Tẩ'],
            'discount_type' => ['data' => 'discount_type', 'name' => 'discount_type', 'title' => 'Loại Voucher'],
            'discount_value' => ['data' => 'discount_value', 'name' => 'discount_value', 'title' => 'Giá trị Giảm'],
            'min_order_value' => ['data' => 'min_order_value', 'name' => 'min_order_value', 'title' => 'Đơn Hầng Tối Thiểu'],
            'start_date' => ['data' => 'start_date', 'name' => 'start_date', 'title' => 'Ngày bắt đầu'],
            'end_date' => ['data' => 'end_date', 'name' => 'end_date', 'title' => 'Ngày kết thúc '],
            'status' => ['data' => 'status', 'name' => 'status', 'title' => 'Trạng thái'],
            'usage_limit' => ['data' => 'usage_limit', 'name' => 'usage_limit', 'title' => 'Giới hạn sử dụng'],
            
            // 'created_at' => ['data' => 'created_at', 'name' => 'created_at', 'title' => 'Created At'],
            // 'updated_at' => ['data' => 'updated_at', 'name' => 'updated_at', 'title' => 'Updated At'],
            'action' => ['data' => 'action', 'name' => 'action', 'title' => 'Action', 'orderable' => false, 'searchable' => false],
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Voucher_' . date('YmdHis');
    }
}
