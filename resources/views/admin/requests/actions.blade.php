<div class="flex items-center space-x-3">
    <a href="{{ route('admin.requests.show', $request->id) }}"
        wire:navigate
        class="text-bnhs-blue hover:text-bnhs-blue-600 font-medium transition">
        View
    </a>

    <button
        wire:click.stop="editRequest({{ $request->id }})"
        class="text-amber-600 hover:text-amber-800 font-medium transition">
        Edit
    </button>

    <button
        wire:click.stop="deleteRequest({{ $request->id }})"
        class="text-red-600 hover:text-red-800 font-medium transition">
        Delete
    </button>
</div>