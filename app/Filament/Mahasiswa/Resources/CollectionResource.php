<?php

namespace App\Filament\Mahasiswa\Resources;

use App\Filament\Mahasiswa\Resources\CollectionResource\Pages;
use App\Filament\Mahasiswa\Resources\CollectionResource\RelationManagers;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Forms\Components\TextInput::make('user_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('recipe_id')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('recipe.image')
                    ->label('Foto Resep')
                    ->disk('public')
                    ->height(50)
                    ->width(50)
                    ->circular()
                    ->getStateUsing(function ($record) {
                        return $record->recipe?->image ?? null;
                    }),

                Tables\Columns\TextColumn::make('recipe.title')
                    ->label('Nama Resep')
                    ->searchable()
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->label('Ditambahkan Pada')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([])
            ->actions([
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
            //
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


    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('user_id', auth()->id())
            ->with('recipe');
    }
}
