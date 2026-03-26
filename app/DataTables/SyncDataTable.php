<?php

namespace App\DataTables;

use App\Facades\Html;
use App\Models\Sync;
use App\Modules\Sync\Enums\SyncTaskStatusEnum;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Column;

final class SyncDataTable extends BaseDataTable
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
            ->editColumn('status', function ($query) {
                return SyncTaskStatusEnum::from($query->status)->toString();
            })
            ->editColumn('available_at', function ($query) {
                return $query->available_at;
            })
            ->editColumn('created_at', function ($query) {
                return $query->created_at;
            })
            ->editColumn('finished_at', function ($query) {
                return $query->finished_at;
            })
            ->rawColumns(['actions']);
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(): QueryBuilder
    {
        $date = now()->subDays(14)->format('Y-m-d');

        return Sync::query()
            ->select([
                'sync.*',
            ])
            ->where('created_at', '>', $date)
            ;
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('uuid')
                ->title(__('UUID'))
                ->searchable(false)
                ->orderable(true),
            Column::make('name')
                ->title(__('Name'))
                ->searchable(false)
                ->orderable(false),

            Column::make('status')
                ->title(__('Status'))
                ->searchable(false)
                ->orderable(true),

            Column::make('attempts')
                ->title(__('Attempts'))
                ->searchable(false)
                ->orderable(false),

            Column::make('available_at')
                ->title(__('Available At'))
                ->searchable(false)
                ->orderable(true),

            Column::make('created_at')
                ->title(__('Created At'))
                ->searchable(false)
                ->orderable(true),

            Column::make('finished_at')
                ->title(__('Finished At'))
                ->searchable(false)
                ->orderable(true),

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
        if (in_array($query->status, [
            SyncTaskStatusEnum::Failed->value,
            SyncTaskStatusEnum::Finished->value,
            SyncTaskStatusEnum::Duplicate->value,
        ])
        ) {
            $actions = Html::Link(
                route('sync.details', ['uuid' => $query->uuid]),
                '<i class="bi bi-eye md-icon"></i>',
                ['class' => 'p-1']
            );
        }

        if ($this->isAdmin) {
            $actions .= '';
        }

        return $actions;
    }

    public function getCollect(): Collection
    {
        $out = [];

        return collect($out);
    }
}
