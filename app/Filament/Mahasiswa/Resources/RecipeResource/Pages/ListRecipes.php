<?php

namespace App\Filament\Mahasiswa\Resources\RecipeResource\Pages;

use App\Filament\Mahasiswa\Resources\RecipeResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Notifications\Notification;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->wrap()
                ->suffixAction(function ($record) {
                    return Action::make('addToCollection')
                        ->icon('heroicon-o-star') // Bintang putih
                        ->tooltip('Tambah ke Koleksi Saya')
                        ->color('gray')
                        ->action(function () use ($record) {
                            /** @var \App\Models\Mahasiswa $mahasiswa */
                            $mahasiswa = auth('mahasiswa')->user();

                            $collection = $mahasiswa->collections()->firstOrCreate(
                                ['name' => 'Koleksi Saya'],
                                ['description' => 'Koleksi pribadi']
                            );

                            $collection->recipes()->syncWithoutDetaching([$record->id]);

                            Notification::make()
                                ->title('Resep berhasil ditambahkan ke Koleksi Saya')
                                ->success()
                                ->send();
                        });
                }),
        ];
    }
}
