@php
$recipeId = $getRecord()->id;
@endphp

<button
    wire:click="addToCollection({{ $recipeId }})"
    class="text-xl text-white hover:text-black transition duration-200"
    title="Tambahkan ke Koleksi Saya">
    &#11088;
</button>