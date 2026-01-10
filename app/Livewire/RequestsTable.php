<?php

namespace App\Livewire;

use App\Models\Request;
use App\Models\RequestLog;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Rappasoft\LaravelLivewireTables\Views\Filters\DateFilter;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use App\Jobs\SendRequestStatusEmail;

class RequestsTable extends DataTableComponent
{
    protected $model = Request::class;

    public array $statuses = [
        'pending' => 'Pending',
        'processing' => 'Processing',
        'ready' => 'Ready',
        'completed' => 'Completed',
    ];

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setDefaultSort('created_at', 'desc')
            ->setSelectAllStatus(false)
            ->setQueryStringEnabled()
            // 1. UI LAYOUT: Matches the image "Filters" dropdown and clean look
            ->setFilterLayoutPopover()
            ->setSelectAllStatus(false) // Only select rows displayed on the current page

            // 2. TABLE STYLING: Matches the image's spacing and borders
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

            // 3. OPERATIONAL SETTINGS
            ->setLoadingPlaceholderStatus(false)
            ->setOfflineIndicatorDisabled()
            ->setSearchDebounce(300)
            ->setPageName('requests-table')
            ->setBulkActionConfirms([
                'bulkDelete' => 'Are you sure you want to delete the selected requests? This action cannot be undone.',
            ]);
    }

    public function columns(): array
    {
        return [
            Column::make('Tracking ID', 'tracking_id')
                ->format(fn($value) => "<span class='font-medium text-gray-900'>{$value}</span>")
                ->html()
                ->searchable()
                ->sortable(),

            Column::make('Student Details')
                ->label(fn($row) => <<<HTML
                    <div class="flex flex-col">
                        <span class="text-sm font-medium text-gray-900">{$row->full_name}</span>
                        <span class="text-xs text-gray-500">LRN: {$row->lrn}</span>
                    </div>
                HTML)
                ->html()
                ->searchable(
                    fn(Builder $query, $term) =>
                    $query->orWhere('first_name', 'ilike', "%{$term}%")
                        ->orWhere('last_name', 'ilike', "%{$term}%")
                        ->orWhere('lrn', 'ilike', "%{$term}%")
                ),

            Column::make('Academic Info')
                ->label(fn($row) => <<<HTML
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-900">{$row->grade_level}</span>
                        <span class="text-xs text-gray-500">{$row->section}</span>
                        <span class="text-xs text-gray-500">{$row->track_strand}</span>
                    </div>
                HTML)
                ->html(),

            Column::make('Document')
                ->label(fn($row) => <<<HTML
                    <div class="flex flex-col">
                        <span class="text-sm text-gray-900">{$row->documentType?->name}</span>
                        <span class="text-xs font-semibold text-bnhs-blue">Qty: {$row->quantity}</span>
                    </div>
                HTML)
                ->html(),

            Column::make('Status', 'status')
                ->format(function ($value, $row) {
                    $styles = match ($value) {
                        'pending'    => 'bg-gray-100 text-gray-800',
                        'processing' => 'bg-blue-100 text-blue-800',
                        'ready'      => 'bg-green-100 text-green-800',
                        'completed'  => 'bg-purple-100 text-purple-800',
                        default      => 'bg-gray-100 text-gray-800',
                    };
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}'>" . ucfirst($value) . "</span>";
                })
                ->html()
                ->sortable(),

            // FIX: Using format() ensures the 'created_at' data is linked for sorting
            Column::make('Requested Date', 'created_at')
                ->format(fn($value) => "<span class='text-sm text-gray-500'>" . $value->format('M d, Y') . "</span>")
                ->html()
                ->sortable(),

            Column::make('Actions')
                ->label(fn($row) => view('admin.requests.actions', ['request' => $row]))
                ->html(),
        ];
    }

    #[On('refreshDatatable')]
    public function refresh()
    {
        $this->dispatch('refresh');
    }

    public function editRequest($id = null)
    {
        $this->dispatch('openRequestModal', requestId: $id);
    }

    public function deleteRequest($id = null)
    {
        $this->dispatch('openDeleteModal', requestId: $id);
    }

    public function builder(): Builder
    {
        // Use the absolute path to your model
        return \App\Models\Request::query()
            ->select('requests.*')
            ->with(['documentType', 'processor']);
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options(['all' => 'All Status'] + $this->statuses)
                ->filter(function (Builder $query, string $value) {
                    if ($value !== 'all') {
                        $query->where('status', $value);
                    }
                }),

            DateFilter::make('Requested On')
                ->filter(function (Builder $query, string $value) {
                    $query->whereDate('requests.created_at', $value);
                }),
        ];
    }

    public function bulkActions(): array
    {
        return [
            'setStatusPending' => 'Set Pending',
            'setStatusProcessing' => 'Set Processing',
            'setStatusReady' => 'Set Ready',
            'setStatusCompleted' => 'Set Completed',
            'bulkDelete' => 'Delete Selected',
        ];
    }

    public function setStatusPending(): void
    {
        $this->bulkUpdateStatus('pending');
    }
    public function setStatusProcessing(): void
    {
        $this->bulkUpdateStatus('processing');
    }
    public function setStatusReady(): void
    {
        $this->bulkUpdateStatus('ready');
    }
    public function setStatusCompleted(): void
    {
        $this->bulkUpdateStatus('completed');
    }

    public function bulkDelete(): void
    {
        $ids = $this->getSelected();
        if (empty($ids)) return;

        DB::transaction(function () use ($ids) {
            Request::whereIn('id', $ids)->delete();
        });

        $this->clearSelected();
        $this->dispatch('notify', type: 'success', message: 'Selected requests deleted successfully.');
    }

    protected function bulkUpdateStatus(string $status): void
    {
        $ids = $this->getSelected();
        if (empty($ids)) return;

        // Wrap in transaction for better data integrity
        DB::transaction(function () use ($ids, $status) {
            $requests = Request::whereIn('id', $ids)->select('id', 'status', 'email')->get();
            $logs = [];
            $updatedRequestIds = [];

            foreach ($requests as $request) {
                $oldStatus = $request->status;

                if ($oldStatus !== $status) {
                    $request->status = $status;
                    $request->processed_by = $request->processed_by ?? Auth::id();
                    $request->save(); // Save individual models to trigger observers
                    $updatedRequestIds[] = $request->id;

                    $logs[] = [
                        'user_id' => Auth::id(),
                        'request_id' => $request->id,
                        'action' => "Updated status from {$oldStatus} to {$status}",
                        'created_at' => now(),
                    ];

                    // Dispatch the email job for each request
                    SendRequestStatusEmail::dispatch($request, $oldStatus, $status);
                }
            }

            if (!empty($logs)) {
                RequestLog::insert($logs);
            }
        });

        $this->clearSelected();
        $this->dispatch('notify', type: 'success', message: 'Selected requests updated successfully.');
    }
}
