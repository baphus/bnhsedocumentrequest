<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Livewire\Attributes\On;

class UsersTable extends DataTableComponent
{
    protected $model = User::class;

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
            ->setPageName('users-table');
    }

    public function columns(): array
    {
        return [
            Column::make('Name', 'name')
                ->searchable()
                ->sortable()
                ->format(fn($value) => "<span class='font-medium text-gray-900'>{$value}</span>")
                ->html(),

            Column::make('Email', 'email')
                ->searchable()
                ->sortable(),

            Column::make('Role', 'role')
                ->format(function ($value) {
                    $styles = match ($value) {
                        'admin'     => 'bg-purple-100 text-purple-800',
                        'registrar' => 'bg-blue-100 text-blue-800',
                        default      => 'bg-gray-100 text-gray-800',
                    };
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}'>" . ucfirst($value) . "</span>";
                })
                ->html()
                ->sortable(),

            Column::make('Status', 'status')
                ->format(function ($value) {
                    $styles = match ($value) {
                        'active'   => 'bg-green-100 text-green-800',
                        'inactive' => 'bg-red-100 text-red-800',
                        default     => 'bg-gray-100 text-gray-800',
                    };
                    return "<span class='inline-flex px-2.5 py-0.5 rounded-full text-xs font-medium {$styles}'>" . ucfirst($value) . "</span>";
                })
                ->html()
                ->sortable(),

            Column::make('Created', 'created_at')
                ->format(fn($value) => $value->format('M d, Y'))
                ->sortable(),

            Column::make('Last Login', 'last_login_at')
                ->format(fn($value) => $value ? $value->diffForHumans() : 'Never')
                ->sortable(),

            Column::make('Actions')
                ->label(fn($row) => view('admin.users.actions', ['user' => $row]))
                ->html(),
        ];
    }

    public function filters(): array
    {
        return [
            SelectFilter::make('Role')
                ->options([
                    '' => 'All Roles',
                    'admin' => 'Admin',
                    'registrar' => 'Registrar',
                ])
                ->filter(function (Builder $query, string $value) {
                    if ($value !== '') {
                        $query->where('role', $value);
                    }
                }),

            SelectFilter::make('Status')
                ->options([
                    '' => 'All Status',
                    'active' => 'Active',
                    'inactive' => 'Inactive',
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
        return User::query();
    }
}
