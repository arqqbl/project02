<div class="space-y-4">
    @if ($record->image)
        <img src="{{ Storage::url($record->image) }}" alt="Foto Resep" class="rounded-lg w-full h-auto">
    @endif

    <div>
        <h3 class="font-bold">Deskripsi:</h3>
        <p>{{ $record->description }}</p>
    </div>

    <div>
        <h3 class="font-bold">Bahan-bahan:</h3>
        <ul class="list-disc ml-5">
            @foreach (explode("\n", $record->ingredients) as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <div>
        <h3 class="font-bold">Langkah-langkah:</h3>
        <ol class="list-decimal ml-5">
            @foreach (explode("\n", $record->steps) as $step)
                <li>{{ $step }}</li>
            @endforeach
        </ol>
    </div>
</div>
