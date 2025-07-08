<?php

namespace App\Filament\Mahasiswa\Resources;

use App\Models\Recipe;
use App\Models\Collection;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Storage;
use App\Filament\Mahasiswa\Resources\RecipeResource\Pages;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Actions\Action;

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
                ->directory('recipes')
                ->visibility('public')
                ->maxSize(2048),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image')
                    ->label('Foto')
                    ->disk('public')
                    ->circular()
                    ->height(50)
                    ->width(50)
                    ->getStateUsing(fn($record) => asset("storage/{$record->image}")),

                TextColumn::make('title')
                    ->label('Judul')
                    ->searchable()
                    ->sortable()
                    ->wrap(),

                TextColumn::make('description')
                    ->label('Deskripsi')
                    ->limit(50)
                    ->wrap()
                    ->extraAttributes(['class' => 'cursor-pointer text-blue-600 hover:underline'])
                    ->action(
                        Action::make('preview')
                            ->icon('heroicon-o-eye')
                            ->modalHeading(fn($record) => $record->title)
                            ->modalContent(fn($record) => view('filament.mahasiswa.recipe-preview', ['record' => $record]))
                            ->modalSubmitAction(false)
                            ->modalCancelActionLabel('Tutup')
                    ),

                TextColumn::make('add_to_collection')
                    ->label('')
                    ->html()
                    ->formatStateUsing(function ($record) {
                        $user = auth('mahasiswa')->user();

                        $alreadyFavorited = \App\Models\Collection::where('mahasiswa_id', $user->id)
                            ->where('recipe_id', $record->id)
                            ->exists();

                        $icon = $alreadyFavorited ? '★' : '☆';
                        $color = $alreadyFavorited ? 'text-yellow-500' : 'text-gray-400';
                        $csrf = csrf_token();

                        return <<<HTML
            <form method="POST" action="/mahasiswa/favorite/{$record->id}" style="display:inline;">
                <input type="hidden" name="_token" value="{$csrf}">
                <button
                    type="submit"
                    class="{$color} hover:text-yellow-600 text-xl"
                    style="border: none; background: none; cursor: pointer;"
                    title="Tambahkan ke Koleksi Favorit"
                >
                    {$icon}
                </button>
            </form>
        HTML;
                    }),


            ])
            ->actions([])
            ->bulkActions([])
            ->recordAction(null); // Biar tidak auto buka form edit
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListRecipes::route('/'),
        ];
    }
}
