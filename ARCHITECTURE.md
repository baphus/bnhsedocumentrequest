# Laravel Livewire SPA Architecture

## Overview

This application has been refactored into a Single Page Application (SPA)-like experience using **Livewire v3**, Blade components, and Alpine.js. The architecture provides fast, dynamic interactions without full page reloads while maintaining Laravel's server-driven rendering benefits.

## Architecture Structure

```
app/
├── Livewire/
│   ├── Pages/              # Livewire page components (full pages)
│   │   ├── Dashboard.php
│   │   └── Requests/
│   │       ├── Index.php
│   │       └── Show.php
│   ├── Tables/             # Table components (Rappasoft Livewire Tables)
│   │   └── RequestsTable.php
│   ├── Components/         # Reusable Livewire components
│   ├── Forms/              # Livewire Form Objects for validation
│   │   ├── UserForm.php
│   │   ├── RequestForm.php
│   │   └── RequestStatusForm.php
│   ├── RequestsTable.php   # Existing table component
│   └── UserModal.php       # Existing user modal component

resources/views/
├── components/             # Reusable Blade components
│   ├── button.blade.php
│   ├── modal-base.blade.php
│   ├── confirm-modal.blade.php
│   ├── alert.blade.php
│   ├── empty-state.blade.php
│   └── loading-skeleton.blade.php
├── livewire/
│   ├── pages/             # Livewire page views
│   │   ├── dashboard.blade.php
│   │   └── requests/
│   │       ├── index.blade.php
│   │       └── show.blade.php
│   └── tables/            # Table-specific views
│       └── requests-table.blade.php
└── layouts/
    └── app.blade.php      # Main layout with wire:navigate
```

## Key Components

### 1. Reusable UI Components

#### Button Component (`components/button.blade.php`)
- **Variants**: primary, secondary, danger, success, outline
- **Sizes**: sm, md, lg
- **Features**: Loading states, disabled states, wire:click support
- **Usage**:
```blade
<x-button variant="primary" size="md" wire:click="save" :loading="$saving">
    Save Changes
</x-button>
```

#### Modal Component (`components/modal-base.blade.php`)
- **Sizes**: sm, md, lg, xl, full
- **Features**: Backdrop click handling, persistent mode, Livewire event integration
- **Usage**:
```blade
<x-modal-base id="my-modal" title="Modal Title" size="md">
    <!-- Content -->
    <x-slot name="footer">
        <!-- Footer actions -->
    </x-slot>
</x-modal-base>
```

#### Alert Component (`components/alert.blade.php`)
- **Types**: success, error, warning, info
- **Features**: Dismissible, custom titles
- **Usage**:
```blade
<x-alert type="success" dismissible title="Success!">
    Your changes have been saved.
</x-alert>
```

#### Empty State Component (`components/empty-state.blade.php`)
- Reusable empty states for lists/tables
- Custom icons, titles, descriptions, and actions

#### Loading Skeleton Component (`components/loading-skeleton.blade.php`)
- **Types**: default, table, card, list
- Shows loading states while data is being fetched

### 2. Livewire Form Objects

Form Objects encapsulate validation logic and form state:

```php
// app/Livewire/Forms/UserForm.php
class UserForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    
    public function save(): User
    {
        $this->validate();
        // Save logic
    }
}
```

**Benefits**:
- Centralized validation rules
- Reusable across create/edit flows
- Cleaner component code

### 3. Livewire Page Components

Page components handle full page logic:

```php
// app/Livewire/Pages/Dashboard.php
class Dashboard extends Component
{
    #[Computed]
    public function stats()
    {
        return [
            'total' => Request::count(),
            // ...
        ];
    }
    
    public function render()
    {
        return view('livewire.pages.dashboard');
    }
}
```

**Features**:
- Uses `#[Computed]` for efficient property access
- Clean separation of logic and view
- Reactive updates without page reloads

### 4. Table Components

Using **Rappasoft Laravel Livewire Tables** for feature-rich tables:

```php
// app/Livewire/Tables/RequestsTable.php
class RequestsTable extends DataTableComponent
{
    protected $model = Request::class;
    
    public function columns(): array
    {
        return [
            Column::make('Tracking ID', 'tracking_id')
                ->searchable()
                ->sortable(),
            // ...
        ];
    }
    
    public function filters(): array
    {
        return [
            SelectFilter::make('Status')
                ->options([...])
        ];
    }
}
```

**Features**:
- Live search
- Column sorting
- Multi-filtering
- Pagination
- Bulk actions

## SPA Navigation

### wire:navigate Implementation

All navigation links use `wire:navigate` for instant page transitions:

```blade
<a href="{{ route('admin.dashboard') }}" wire:navigate>
    Dashboard
</a>
```

**Benefits**:
- Instant page transitions
- Preserves scroll position
- Prefetches pages on hover
- No full page reloads

### Route Configuration

Routes point directly to Livewire components:

```php
// routes/admin.php
Route::get('/dashboard', \App\Livewire\Pages\Dashboard::class)
    ->name('dashboard');
    
Route::get('/requests', \App\Livewire\Pages\Requests\Index::class)
    ->name('requests.index');
```

## State Management

### Component Communication

#### Parent → Child (Props)
```php
// Parent component
<livewire:child-component :data="$data" />
```

#### Child → Parent (Events)
```php
// Child emits event
$this->dispatch('data-updated', data: $newData);

// Parent listens
#[On('data-updated')]
public function handleUpdate($data) { }
```

#### Cross-Component Communication
```php
// Component A
$this->dispatch('notify', type: 'success', message: 'Saved!');

// Layout listens (globally)
<div @notify.window="showNotification($event.detail)">
```

### Toast Notifications

Global toast system in the layout:

```php
// In any component
$this->dispatch('notify', type: 'success', message: 'Operation successful!');
```

## Forms & Validation

### Inline Validation

Livewire provides real-time validation:

```blade
<input wire:model.blur="form.email" type="email" />
@error('form.email') 
    <span class="text-red-500">{{ $message }}</span> 
@enderror
```

### Form Objects

Validation logic lives in Form Objects:

```php
class UserForm extends Form
{
    #[Validate('required|email|unique:users,email')]
    public string $email = '';
    
    // Dynamic validation rules
    protected function rules()
    {
        return [
            'email' => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->userId),
            ],
        ];
    }
}
```

## Best Practices

### 1. Component Organization

- **Pages**: Full page components (`app/Livewire/Pages/`)
- **Tables**: Table components (`app/Livewire/Tables/`)
- **Components**: Reusable UI components (`app/Livewire/Components/`)
- **Forms**: Form objects (`app/Livewire/Forms/`)

### 2. Performance Optimization

- Use `#[Computed]` properties for expensive calculations
- Eager load relationships: `->with(['documentType', 'processor'])`
- Use `wire:key` correctly for lists
- Avoid unnecessary re-renders with `wire:ignore`

### 3. Reusability

- Create generic components that accept props
- Use Form Objects for validation logic
- Extract common table patterns into base classes
- Share state via events, not global variables

### 4. User Experience

- Show loading states (`:loading` prop on buttons)
- Use skeleton loaders for async content
- Provide immediate feedback (toast notifications)
- Handle errors gracefully with user-friendly messages

## Migration Guide

### Converting a Blade Page to Livewire

1. **Create Livewire Component**:
```php
php artisan make:livewire Pages/MyPage
```

2. **Move Logic from Controller**:
```php
// Old Controller
public function index()
{
    $items = Item::paginate(10);
    return view('my-page', compact('items'));
}

// New Livewire Component
class MyPage extends Component
{
    public function render()
    {
        return view('livewire.pages.my-page', [
            'items' => Item::paginate(10),
        ]);
    }
}
```

3. **Update Route**:
```php
// Old
Route::get('/my-page', [MyController::class, 'index']);

// New
Route::get('/my-page', \App\Livewire\Pages\MyPage::class);
```

4. **Add wire:navigate** to navigation links

5. **Use reusable components** (`<x-button>`, `<x-modal>`, etc.)

## Example: Complete Feature Flow

### Creating a New Feature

1. **Create Form Object**:
```php
// app/Livewire/Forms/ItemForm.php
class ItemForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';
    
    public function save(): Item
    {
        $this->validate();
        return Item::create($this->only('name'));
    }
}
```

2. **Create Page Component**:
```php
// app/Livewire/Pages/Items/Index.php
class Index extends Component
{
    public ItemForm $form;
    
    public function save()
    {
        $this->form->save();
        $this->dispatch('notify', type: 'success', message: 'Item created!');
        $this->form->reset();
    }
    
    public function render()
    {
        return view('livewire.pages.items.index');
    }
}
```

3. **Create View**:
```blade
<x-app-layout>
    <form wire:submit="save">
        <x-text-input wire:model="form.name" />
        @error('form.name') <span>{{ $message }}</span> @enderror
        
        <x-button type="submit" variant="primary">Save</x-button>
    </form>
</x-app-layout>
```

4. **Add Route**:
```php
Route::get('/items', \App\Livewire\Pages\Items\Index::class)
    ->name('items.index');
```

## Testing

Test Livewire components like any other component:

```php
use Livewire\Livewire;

test('can create item', function () {
    Livewire::test(Items\Index::class)
        ->set('form.name', 'Test Item')
        ->call('save')
        ->assertDispatched('notify');
        
    $this->assertDatabaseHas('items', ['name' => 'Test Item']);
});
```

## Troubleshooting

### Common Issues

1. **Component not updating**: Check `wire:key` is set correctly
2. **Validation not working**: Ensure `#[Validate]` attributes are present
3. **Navigation not smooth**: Verify `wire:navigate` is on all links
4. **Events not firing**: Check event names match exactly

### Debugging

- Use `@dump($variable)` in Blade templates
- Check browser console for Livewire errors
- Use Laravel Debugbar with Livewire integration
- Enable Livewire's debugging: `LIVEWIRE_DEBUG=true`

## Next Steps

To continue the migration:

1. ✅ Admin Dashboard - **Complete**
2. ✅ Request Management - **Complete**
3. ⏳ Public Request Creation Flow
4. ⏳ OTP Verification
5. ⏳ Tracking Page
6. ⏳ User Management Pages
7. ⏳ Document Types Management
8. ⏳ Settings Page

Each feature should follow the same patterns established here for consistency.
