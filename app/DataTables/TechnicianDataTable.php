<?php

namespace App\DataTables;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Facades\Auth;
use DataTables;

class TechnicianDataTable extends DataTable
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
            ->setRowId('id_repair')
            ->addColumn('index', function ($repair) {
                return  $this->i++;
        })
        ->rawColumns(['index']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Repair $model): QueryBuilder
    {
        return $model->newQuery()->where('type', Auth::user()->department);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('technician-table')
            ->columns($this->getColumns())
            // ->minifiedAjax()
            //->dom('Bfrtip')
            // ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
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
            Column::make('index'),
            Column::make('status'),
            Column::make('details'),
            Column::make('site'),
            Column::make('status_repair'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Technician_' . date('YmdHis');
    }
}
