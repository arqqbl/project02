@php
$currentUser = auth()->user();
$recipe = $getState()['record']; // ✅ Ambil record dari state
@endphp

@if ($currentUser && $recipe)
@php
$alreadyFavorited = \App\Models\Collection::where('user_id', $currentUser->id)
->where('recipe_id', $recipe->id)
->exists();

$icon = $alreadyFavorited ? '★' : '☆';
$color = $alreadyFavorited ? 'text-yellow-500' : 'text-gray-400';
@endphp

<form method="POST" action="{{ route('mahasiswa.favorite', $recipe->id) }}" style="display:inline;">
    @csrf
    <button
        type="submit"
        class="{{ $color }} hover:text-yellow-600 text-xl"
        style="border: none; background: none; cursor: pointer;"
        title="Tambahkan ke Koleksi Favorit">
        {{ $icon }}
    </button>
</form>

@else
<span class="text-red-500">Not Authenticated or no recipe</span>
@endif