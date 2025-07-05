<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CollectionResource\Pages;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class CollectionResource extends Resource
{
    protected static ?string $model = Collection::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark-square';
    protected static ?string $navigationGroup = 'Manajemen Resep';
    protected static ?string $modelLabel = 'Koleksi';
    protected static ?string $pluralModelLabel = 'Koleksi Resep';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(255),

                Forms\Components\Textarea::make('description')
                    ->rows(3)
                    ->maxLength(65535)
                    ->columnSpanFull(),

                Forms\Components\Select::make('recipes')
                    ->multiple()
                    ->relationship('recipes', 'title') // pakai 'title' bukan 'name'
                    ->preload()
                    ->searchable()
                    ->label('Pilih Resep untuk Koleksi Ini'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('recipes_count')
                    ->counts('recipes')
                    ->label('Jumlah Resep')
                    ->sortable(),

                Tables\Columns\TextColumn::make('recipes_list')
                    ->label('Resep dalam Koleksi')
                    ->formatStateUsing(fn ($record) => $record->recipes->pluck('title')->implode(", "))
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // RelationManagers\RecipesRelationManager::class, // jika ingin tampilkan relasi di tab khusus
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCollections::route('/'),
            'create' => Pages\CreateCollection::route('/create'),
            'edit' => Pages\EditCollection::route('/{record}/edit'),
        ];
    }

    // Untuk menghindari N+1 Query pada relasi
    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()->with('recipes');
    }
}
