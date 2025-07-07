<?php

namespace App\Filament\Mahasiswa\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
             Stat::make('Total Koleksi', \App\Models\Collection::count())
                ->description('Koleksi resep favorit yang telah disimpan')
                ->icon('heroicon-o-bookmark')
                ->color('success'),

            Stat::make('Total Resep', \App\Models\Recipe::count())
                ->description('Resep yang dapat dimasak oleh mahasiswa')
                ->icon('heroicon-o-book-open')
                ->color('info'),

            Stat::make('Resep Terbaru', \App\Models\Recipe::latest()->first()?->name ?? 'Belum ada')
                ->description('Nama resep terbaru yang ditambahkan')
                ->icon('heroicon-o-sparkles')
                ->color('warning'),
        ];
    }
}
