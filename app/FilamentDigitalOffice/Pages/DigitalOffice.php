<?php

namespace App\FilamentDigitalOffice\Pages;

use Artificertech\FilamentMultiContext\Concerns\ContextualPage;
use Filament\Pages\Page;

class DigitalOffice extends Page
{
    use ContextualPage;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';

    protected static string $view = 'filament-digital-office.pages.digital-office';
}
