<?php

namespace App\Livewire\Tables;

use App\Models\Document;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Livewire\Attributes\On;

class DocumentTable extends DataTableComponent
{
    protected $model = Document::class;

    #[On('refreshDatatable')]
    public function refresh()
    {
        // This is a dummy method to refresh the table from external components.
    }

    public function editDocument($documentId = null)
    {
        $this->dispatch('openDocumentModal', documentId: $documentId);
    }

    public function deleteDocument($documentId = null)
    {
        $this->dispatch('openDeleteDocumentModal', documentId: $documentId);
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
            ->setLoadingPlaceholderStatus(false)
            ->setOfflineIndicatorDisabled()
            ->setSearchDebounce(300)
            ->setPageName('documents-table');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-gray-900'>{$value}</span>")
                ->html(),

            Column::make('Category', 'category')
                ->searchable()
                ->sortable(),
            
            Column::make('Processing Days', 'processing_days')
                ->sortable(),

            Column::make('Status', 'is_active')
                ->format(function ($value) {
                    $styles = $value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    $text = $value ? 'Active' : 'Inactive';
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}'>" . $text . "</span>";
                })
                ->html()
                ->sortable(),

            Column::make('Created', 'created_at')
                ->format(fn($value) => $value->format('M d, Y'))
                ->sortable(),
                
            Column::make('Actions', 'id')
                ->format(fn($value, $row) => view('livewire.pages.document-types.actions', ['documentId' => $value])->render())
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status', 'is_active')
                ->options([
                    '' => 'All',
                    '1' => 'Active',
                    '0' => 'Inactive',
                ])
                ->filter(function (Builder $query, string $value) {
                    if ($value !== '') {
                        $query->where('is_active', $value);
                    }
                }),
        ];
    }

    public function builder(): Builder
    {
        return Document::query();
    }
}
