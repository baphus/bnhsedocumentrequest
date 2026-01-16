<?php

namespace App\View\Components;

use Illuminate\View\Component;

class RequestStatus extends Component
{
    public $status;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($status)
    {
        $this->status = $status;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.request-status');
    }

    public static function getStatusClasses(string $status): array
    {
        switch (strtolower($status)) {
            case 'pending':
                return [
                    'badge' => 'bg-yellow-100 text-yellow-800',
                    'text' => 'text-yellow-600',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
            case 'verified':
                return [
                    'badge' => 'bg-blue-100 text-blue-800',
                    'text' => 'text-blue-600',
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
            case 'processing':
                return [
                    'badge' => 'bg-indigo-100 text-indigo-800',
                    'text' => 'text-indigo-600',
                    'icon' => 'M13 10V3L4 14h7v7l9-11h-7z',
                ];
            case 'ready':
                return [
                    'badge' => 'bg-purple-100 text-purple-800',
                    'text' => 'text-purple-600',
                    'icon' => 'M5 13l4 4L19 7',
                ];
            case 'completed':
                return [
                    'badge' => 'bg-green-100 text-green-800',
                    'text' => 'text-green-600',
                    'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
            case 'rejected':
                return [
                    'badge' => 'bg-red-100 text-red-800',
                    'text' => 'text-red-600',
                    'icon' => 'M6 18L18 6M6 6l12 12',
                ];
            default:
                return [
                    'badge' => 'bg-gray-100 text-gray-800',
                    'text' => 'text-gray-600',
                    'icon' => 'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z',
                ];
        }
    }
}
