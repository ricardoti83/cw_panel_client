<?php

namespace App\Filament\Pages;

use App\Models\Stack;
use Filament\Pages\Page;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Painel de Controle';
    protected static ?string $title = 'Painel de Controle';
    protected static ?int $navigationSort = -1;
    protected static bool $shouldRegisterNavigation = false;

    protected static string $view = 'filament.pages.dashboard';

    public function getStacksProperty()
    {
        return Stack::where('user_id', auth()->id())->get();
    }
}
