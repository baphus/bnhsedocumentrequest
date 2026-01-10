<div class="flex items-center space-x-3">
    <button
        wire:click.stop="editUser({{ $userId }})"
        class="text-bnhs-blue hover:text-bnhs-blue-600 font-medium transition">
        Edit
    </button>
    @if((int) $userId !== (int) auth()->id())
    <button
        wire:click.stop="deleteUser({{ $userId }})"
        class="text-red-600 hover:text-red-800 font-medium transition">
        Delete
    </button>
    @endif
</div>