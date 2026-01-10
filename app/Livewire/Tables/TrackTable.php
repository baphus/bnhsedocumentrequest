<?php

namespace App\Livewire\Tables;

use App\Models\Track;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Livewire\Attributes\On;

class TrackTable extends DataTableComponent
{
    protected $model = Track::class;

    #[On('refreshDatatable')]
    public function refresh()
    {
        // This is a dummy method to refresh the table from external components.
    }

    public function editTrack($trackId = null)
    {
        $this->dispatch('openTrackModal', trackId: $trackId);
    }

    public function deleteTrack($trackId = null)
    {
        $this->dispatch('openDeleteTrackModal', trackId: $trackId);
    }

    public function toggleTrack($trackId)
    {
        $track = Track::find($trackId);
        if ($track) {
            $track->update(['is_active' => !$track->is_active]);
            $this->dispatch('refreshDatatable');
        }
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
            ->setPageName('tracks-table');
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
                ->sortable(),

            Column::make('Category', 'category')
                ->searchable()
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-gray-900'>{$value}</span>")
                ->html(),

            Column::make('Code', 'code')
                ->searchable()
                ->sortable()
                ->format(fn($value) => "<span class='font-mono text-sm bg-gray-100 px-2 py-1 rounded'>{$value}</span>")
                ->html(),

            Column::make('Name', 'name')
                ->searchable()
                ->sortable(),

            Column::make('Status', 'is_active')
                ->format(function ($value, $row) {
                    $styles = $value ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800';
                    $text = $value ? 'Active' : 'Inactive';
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}' wire:click.stop='toggleTrack({$row->id})' style='cursor: pointer;'>" . $text . "</span>";
                })
                ->html()
                ->sortable(),

            Column::make('Created', 'created_at')
                ->format(fn($value) => $value->format('M d, Y'))
                ->sortable(),

            Column::make('Actions', 'id')
                ->format(fn($value, $row) => view('livewire.settings.track-actions', ['trackId' => $value])->render())
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
                ->filter(function(Builder $builder, string $value) {
                    if ($value === '1') {
                        return $builder->where('is_active', true);
                    } elseif ($value === '0') {
                        return $builder->where('is_active', false);
                    }
                    return $builder;
                }),
        ];
    }
}
