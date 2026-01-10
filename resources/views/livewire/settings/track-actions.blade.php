<div class="flex items-center space-x-3">
    <button
        wire:click.stop="editTrack({{ $trackId }})"
        class="text-bnhs-blue hover:text-bnhs-blue-600 font-medium transition">
        Edit
    </button>
    <button
        wire:click.stop="deleteTrack({{ $trackId }})"
        class="text-red-600 hover:text-red-800 font-medium transition">
        Delete
    </button>
</div>
