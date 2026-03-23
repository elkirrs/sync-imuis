<?php

namespace App\DataTables;

use App\Models\Connection;
use App\Modules\Connection\Enums\IsActiveConnection;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

final class ConnectionDataTable extends BaseDataTable
{
    /**
     * Build the DataTable class.
     *
     * @param  QueryBuilder  $query  Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        // return (new CollectionDataTable($query))
        return new EloquentDataTable($query)
            ->addColumn('actions', function ($query) {
                return $this->actions($query);
            })
            ->filterColumn('name', function ($query, $keyword) {
                $sql = 'name ~* ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d H:i:s');
            })
            ->editColumn('is_active', function ($query) {
                return IsActiveConnection::from($query->is_active)->toString();
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return Connection::query()
            ->select([
                'connections.*',
            ])
            ->where('type', '=', 'administration')
            ->distinct();
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('name')
                ->title('Name')
                ->orderable(),

            Column::make('description')
                ->title('Description'),

            Column::make('is_active')
                ->title('Active'),

            Column::make('created_at')
                ->title('Created'),

            Column::make('actions')
                ->title('Actions')
                ->orderable(false)
                ->searchable(false),
        ];
    }

    private function actions(
        $query
    ): string {
        $actions = '<a href="'.route('connections.edit', ['id' => $query->id]).'"'
            .' class="p-1"'
            .' title="edit"'
            .'><i class="bi bi-pencil-square md-icon"></i></a>';

        $actions .= '<a href="javascript:void(0)"'
            .' class="delete-item p-1 text-danger"'
            .' data-url="'.route('connections.delete', ['id' => $query->id]).'"'
            .' data-uuid="'.$query->id.'"'
            .' title="delete"'
            .'><i class="bi bi-trash3 md-icon"></i></a>';

        return $actions;
    }

    public function getCollect(): Collection
    {
        $out = [];

        return collect($out);
    }
}
