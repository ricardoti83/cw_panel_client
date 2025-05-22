<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Illuminate\Support\Facades\Http;

class Containers extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-cube';
    protected static string $view = 'filament.pages.containers';
    protected static ?string $title = 'Containers em execução';
    protected static ?string $navigationLabel = 'Containers';

    public $containers = [];

    public function mount(): void
    {
        $response = Http::get('http://dockerctl:3000/containers');

        if ($response->ok()) {
            $this->containers = $response->json();
        }
    }
}
