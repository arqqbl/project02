<?php

namespace App\Filament\Mahasiswa\Resources\RecipeResource\Pages;

use App\Filament\Mahasiswa\Resources\RecipeResource;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;
use Filament\Notifications\Notification;

class ListRecipes extends ListRecords
{
    protected static string $resource = RecipeResource::class;

    protected function getTableSchema(): array
    {
        return [
            TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->wrap()
                ->suffixAction(
                    Action::make('tambahKeKoleksi')
                        ->icon('heroicon-o-star') // Bintang putih
                        ->tooltip('Tambah ke Koleksi Saya')
                        ->action(function ($record) {
                            $user = auth('mahasiswa')->user();

                            if (!$user) {
                                Notification::make()
                                    ->title('Anda belum login sebagai mahasiswa')
                                    ->danger()
                                    ->send();
                                return;
                            }

                            $collection = $user->collections()->firstOrCreate(
                                ['name' => 'Koleksi Saya'],
                                ['description' => 'Koleksi pribadi']
                            );

                            $collection->recipes()->syncWithoutDetaching([$record->id]);

                            Notification::make()
                                ->title('Resep berhasil ditambahkan ke Koleksi Saya')
                                ->success()
                                ->send();
                        })
                ),
        ];
    }
}
