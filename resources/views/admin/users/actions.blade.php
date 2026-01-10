<div class="flex items-center space-x-3">
    <button
        wire:click="$dispatch('openUserModal', {{ $user->id }})"
        class="text-bnhs-blue hover:text-bnhs-blue-600 font-medium transition">
        Edit
    </button>

    @if($user->id !== auth()->id())
    <button
        wire:click="$dispatch('confirmDeleteUser', { userId: {{ $user->id }} })"
        wire:confirm="Are you sure you want to delete this user?"
        class="text-red-600 hover:text-red-800 font-medium transition">
        Delete
    </button>

    @endif
</div>