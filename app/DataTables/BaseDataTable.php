<?php

declare(strict_types=1);

namespace App\DataTables;

use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Collection;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Services\DataTable;

abstract class BaseDataTable extends DataTable
{
    public function __construct(
        public bool $autoWidth = true,
        public bool $paging = true,
        public array $lengthMenu = [25, 50, 100, 250],
        public bool $serverSide = true,
        public bool $searching = false,
        public string|array $ajaxData = []
    ) {
        parent::__construct();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->autoWidth($this->autoWidth)
            ->setTableId($this->filename())
            ->columns($this->getColumns())
            ->paging($this->paging)
            ->serverSide($this->serverSide)
            ->lengthMenu($this->lengthMenu)
            ->searching($this->searching)
            ->footerCallback($this->initFooter())
            ->ajax($this->ajaxData)
            ->orderBy(0, 'asc');
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return class_basename($this).'_'.date('Ymd');
    }

    private function initFooter(): string
    {
        return '';
    }

    abstract public function dataTable(QueryBuilder $query): EloquentDataTable;

    abstract public function query(): QueryBuilder;

    abstract public function getCollect(): Collection;

    abstract public function getColumns(): array;
}
