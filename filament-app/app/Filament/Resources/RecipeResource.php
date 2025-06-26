<?php

namespace App\Filament\Resources;

use Filament\Forms;
use App\Models\Recipe;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use App\Filament\Resources\RecipeResource\Pages;
use App\Filament\Resources\YesResource\Pages\ViewRecipe;



class RecipeResource extends Resource
{
    protected static ?string $model = Recipe::class;
    
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('title')
                ->label('Judul Resep')
                ->required()
                ->maxLength(255),

            Forms\Components\Textarea::make('description')
                ->label('Deskripsi')
                ->required()
                ->rows(3),

            Forms\Components\Textarea::make('ingredients')
                ->label('Bahan-bahan')
                ->required()
                ->rows(5),

            Forms\Components\Textarea::make('steps')
                ->label('Langkah-langkah')
                ->required()
                ->rows(5),

            Forms\Components\FileUpload::make('image')
                ->label('Foto Resep')
                ->image()
                ->directory('recipes') // akan disimpan di storage/app/public/recipes
                ->visibility('public')
                ->maxSize(2048), // max 2MB
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table->columns([
            ImageColumn::make('image')
                ->label('Foto')
                ->circular()
                ->height(100)
                ->width(100),

            TextColumn::make('title')
                ->label('Judul')
                ->searchable(),

            TextColumn::make('description')
                ->label('Deskripsi')
                ->limit(50),
        ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
            'create' => Pages\CreateRecipe::route('/create'),
            'edit' => Pages\EditRecipe::route('/{record}/edit'),
            'view' => Pages\ViewRecipe::route('/{record}'),
        ];
    }
}
