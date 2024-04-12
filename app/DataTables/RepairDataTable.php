<?php

namespace App\DataTables;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Carbon\Carbon;
use Illuminate\Database\Query\IndexHint;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class RepairDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
   public $i=1;
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {

        return (new EloquentDataTable($query))
            ->setRowId('id')
            ->addColumn('created_at', function ($repair) {
                // Format the created_at date using Carbon (replace with desired format)
                return Carbon::parse($repair->created_at)->format('d/m/Y');  // Example: DD/MM/YYYY
            })
            ->addColumn('index', function ($repair) {
                    return  $this->i++;
            })
            ->rawColumns(['created_at','index']);  // Mark 'created_at' as raw for proper formatting
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Repair $model): QueryBuilder
    {
        return $model->newQuery()->with('department');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('repair-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            // ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                // Button::make('excel'),
                // Button::make('csv'),
                // Button::make('pdf'),
                // Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            // Column::computed('action')
            //       ->exportable(false)
            //       ->printable(false)
            //       ->width(60)
            //       ->addClass('text-center'),
            Column::computed('index')->title('ลำดับ'),
            Column::computed('department.department_name')->title('ประเภทงานซ่อม')->searchable(true),
            Column::make('name')->title('ชื่อผู้แจ้งซ่อม')->searchable(true),
            Column::make('details')->title('รายละเอียดงานซ่อม'),
            Column::make('site')->title('สถานที่')->searchable(true),
            Column::make('tag_repair'),
            Column::make('status_repair')->title('สถานะงานเเจ้งซ่อม'),
            Column::make('created_at')->title('วันที่แจ้งซ่อม'),
            //
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Repair_' . date('YmdHis');
    }
}
