<?php

namespace App\Filament\Mahasiswa\Resources;

use App\Models\Collection;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use App\Filament\Mahasiswa\Resources\CollectionResource\Pages;
use Illuminate\Database\Eloquent\Builder;


class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationLabel = 'Koleksi Saya';
    protected static ?string $modelLabel = 'Koleksi';
    protected static ?string $pluralModelLabel = 'Koleksi Resep';
    protected static ?string $navigationGroup = 'Resep Mahasiswa';
    protected static ?string $navigationIcon = 'heroicon-o-star';



    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('recipes_count')
                    ->counts('recipes')
                    ->label('Jumlah Resep')
                    ->sortable(),

                TextColumn::make('recipes_list')
                    ->label('Resep dalam Koleksi')
                    ->formatStateUsing(fn($record) => $record->recipes->pluck('title')->implode(", "))
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([]) // tidak ada tombol edit/view
            ->bulkActions([]); // tidak bisa delete massal
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
        ];
    }



    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('recipes');
    }
}
