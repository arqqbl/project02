@php
    $user = auth()->user();
    $isFavorited = $user && $user->collections()->where('recipe_id', $record->id)->exists();
@endphp

<span class="{{ $isFavorited ? 'text-yellow-500' : 'text-gray-400' }} text-xl">
    {{ $isFavorited ? '★' : '☆' }}
</span>
