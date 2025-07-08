<?php

return [

    'default_panel' => 'admin',

    'panels' => [

        'admin' => [
            'id' => 'admin',
            'path' => 'admin',
            'providers' => [
                \App\Providers\Filament\AdminPanelProvider::class,
            ],
        ],

        'mahasiswa' => [
            'id' => 'mahasiswa',
            'path' => 'mahasiswa',
            'providers' => [
                \App\Providers\Filament\MahasiswaPanelProvider::class,
            ],
        ],

    ],

];
