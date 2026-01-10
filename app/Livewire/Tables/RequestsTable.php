<?php

namespace App\Livewire\Tables;

use App\Models\Request as DocumentRequest;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Livewire\Attributes\On;

class RequestsTable extends DataTableComponent
{
    protected $model = DocumentRequest::class;

    #[On('refreshDatatable')]
    public function refresh()
    {
        $this->dispatch('refresh');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setQueryStringEnabled()
            ->setFilterLayoutPopover()
            ->setTableAttributes([
                'class' => 'min-w-full divide-y divide-gray-200 border-separate border-spacing-0'
            ])
            ->setTheadAttributes(['class' => 'bg-gray-50'])
            ->setThAttributes(fn(Column $column) => [
                'class' => 'px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider border-b border-gray-200',
            ])
            ->setTrAttributes(fn($row, $index) => [
                'class' => 'hover:bg-gray-50 transition-colors bg-white',
            ])
            ->setTdAttributes(fn(Column $column, $row, $colIndex, $rowIndex) => [
                'class' => 'px-6 py-4 whitespace-nowrap text-sm text-gray-700 border-b border-gray-100',
            ])
            ->setSearchDebounce(300)
            ->setPageName('requests-table')
            ->setPerPageAccepted([10, 25, 50, 100])
            ->setDefaultPerPage(25);
    }

    public function columns(): array
    {
        return [
            Column::make('Tracking ID', 'tracking_id')
                ->searchable()
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-bnhs-blue'>{$value}</span>")
                ->html(),

            Column::make('Name', 'first_name')
                ->searchable()
                ->sortable()
                ->format(fn($value, $row) => "<span class='font-medium text-gray-900'>{$row->full_name}</span>")
                ->html(),

            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Document', 'document_type_id')
                ->format(fn($value, $row) => $row->documentType->name ?? 'N/A')
                ->sortable(),

            Column::make('Status', 'status')
                ->format(function ($value) {
                    $styles = match ($value) {
                        'pending' => 'bg-gray-100 text-gray-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'ready' => 'bg-green-100 text-green-800',
                        'completed' => 'bg-purple-100 text-purple-800',
                        default => 'bg-gray-100 text-gray-800',
                    };
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}'>" . ucfirst($value) . "</span>";
                })
                ->html()
                ->sortable(),

            Column::make('Date', 'created_at')
                ->format(fn($value) => $value->format('M d, Y'))
                ->sortable(),

            Column::make('Actions')
                ->label(fn($row) => view('livewire.tables.requests-actions', ['request' => $row]))
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([
                    '' => 'All Status',
                    'pending' => 'Pending',
                    'processing' => 'Processing',
                    'ready' => 'Ready',
                    'completed' => 'Completed',
                ])
                ->filter(function (Builder $query, string $value) {
                    if ($value !== '') {
                        $query->where('status', $value);
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        return DocumentRequest::query()
            ->with(['documentType', 'processor']);
    }
}
