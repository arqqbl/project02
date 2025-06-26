<?php

namespace App\Filament\Resources\RecipeResource\Pages;

use App\Filament\Resources\RecipeResource;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Contracts\View\View;

class ViewRecipe extends ViewRecord
{
    protected static string $resource = RecipeResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }

    public function render(): View
    {
        return view('filament.resources.recipe-resource.pages.view-recipe', [
            'record' => $this->record,
        ]);
    }
}
