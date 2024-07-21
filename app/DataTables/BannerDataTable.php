<?php
namespace App\DataTables;
use App\Models\Banner;
use App\Models\Post;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
class BannerDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', 'banner.action')
            ->editColumn('created_at', fn($data) => $data->created_at->format('d-m-Y H:i:s'))
            ->editColumn('updated_at', fn($data) => $data->updated_at->format('d-m-Y H:i:s'))
            ->editColumn('status', function ($data) {
                if ($data->status == 1) {
                    return "<span class='badge rounded-pill alert-success'>Active</span>";
                } else {
                    return "<span class='badge rounded-pill alert-warning'>Inactive</span>";
                }
            })
            ->addColumn('action', function ($data) {
                $buttonEdit = '';
                $buttonDelete = '';
                if (auth()->user()->can('update banner management')) {
                    $routeEdit = route('admin.banner.edit', $data->id);
                    $buttonEdit = "<a href='$routeEdit' class='btn btn-primary btn-md'>Edit</a>";
                }

                if (auth()->user()->can('delete banner management')) {
                    $routeDelete = route('admin.banner.destroy', $data->id);
                    $buttonDelete = "<a href='$routeDelete' class='btn btn-md font-sm bg-danger'>Delete</a>";
                }
                $element = "$buttonEdit $buttonDelete";
                return $element;
            })
            ->editColumn('image', function ($data) {
                $element = "<div class='col-lg-4 col-sm-4 col-8 flex-grow-1 col-name'>";
                $element .= "<a class='itemside' href='#'>";
                $element .= "<img src='$data->image_url' class='img-sm img-thumbnail' width='100px'>";
                $element .= "</a></div>";
                return $element;
            })
            ->rawColumns(['action', 'status', 'image'])
            ->setRowId(function ($row) {
                return 'row-' . $row->id;
            });
    }
    /**
     * Get the query source of dataTable.
     */
    public function query(Banner $model): QueryBuilder
    {
        return $model->newQuery();
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
            'image' => ['data' => 'image', 'name' => 'image', 'title' => 'Image'],
            'title' => ['data' => 'title', 'name' => 'title', 'title' => 'Title'],
            'status' => ['data' => 'status', 'name' => 'status', 'title' => 'Status'],
            'priority' => ['data' => 'priority', 'name' => 'priority', 'title' => 'Priority'],
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
        return 'Banner_' . date('YmdHis');
    }
}
