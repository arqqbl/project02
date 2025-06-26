<x-filament::page>
    <div class="max-w-3xl mx-auto space-y-6">
        <h1 class="text-3xl font-bold text-center">{{ $record->title }}</h1>

        @if ($record->image)
            <img src="{{ Storage::url($record->image) }}"
                 alt="Foto Resep"
                 class="rounded-lg w-full max-h-96 object-cover">
        @endif

        <div>
            <h2 class="text-xl font-semibold">Deskripsi</h2>
            <p class="text-gray-700">{{ $record->description }}</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Bahan-bahan</h2>
            <p class="whitespace-pre-line text-gray-700">{{ $record->ingredients }}</p>
        </div>

        <div>
            <h2 class="text-xl font-semibold">Langkah-langkah</h2>
            <p class="whitespace-pre-line text-gray-700">{{ $record->steps }}</p>
        </div>

        <a href="{{ route('filament.admin.resources.recipes.index') }}"
           class="inline-block mt-6 text-blue-500 hover:underline">
            ← Kembali ke daftar resep
        </a>
    </div>
</x-filament::page>
