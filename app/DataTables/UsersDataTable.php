<?php

namespace App\DataTables;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

final class UsersDataTable extends BaseDataTable
{
    public bool $isAdmin = false;

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
                $sql = 'users.name ~* ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->filterColumn('email', function ($query, $keyword) {
                $sql = 'users.email ~* ?';
                $query->whereRaw($sql, ["%{$keyword}%"]);
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at->format('Y-m-d H:i:s');
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        return User::query()
            ->select([
                'users.*',
            ])
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

            Column::make('email')
                ->title('Email'),

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
        $actions = '';

        if ($this->isAdmin) {

            $actions = '<a href="'.route('users.edit', ['id' => $query->id]).'"'
                .' class="p-1"'
                .' title="edit"'
                .'><i class="bi bi-pencil-square md-icon"></i></a>';

            $actions .= '<a href="javascript:void(0)"'
                .' class="delete-item p-1 text-danger"'
                .' data-url="'.route('users.destroy', ['id' => $query->id]).'"'
                .' data-id="'.$query->id.'"'
                .' title="delete"'
                .'><i class="bi bi-trash3 md-icon"></i></a>';
        }

        return $actions;
    }

    public function getCollect(): Collection
    {
        $out = [];

        return collect($out);
    }
}
