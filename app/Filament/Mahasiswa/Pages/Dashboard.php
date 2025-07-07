<?php

namespace App\Filament\Mahasiswa\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use App\Filament\Mahasiswa\Widgets\StatsOverview;

class Dashboard extends BaseDashboard
{
    protected function getHeaderWidgets(): array
    {
        return [
            StatsOverview::class, // ← tampilkan widget di atas dashboard
        ];
    }
}
