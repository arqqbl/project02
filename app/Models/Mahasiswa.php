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

    protected function getTableColumns(): array
    {
        return [
            TextColumn::make('deskripsi')
                ->label('Deskripsi')
                ->wrap()
                ->extraAttributes(['style' => 'display: flex; align-items: center; justify-content: space-between;'])
                ->suffix(function ($record) {
                    return view('components.star-action', ['record' => $record]);
                }),
        ];
    }
}
