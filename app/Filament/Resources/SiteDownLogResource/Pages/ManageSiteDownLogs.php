<?php

namespace App\Filament\Resources\SiteDownLogResource\Pages;

use App\Filament\Resources\SiteDownLogResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageSiteDownLogs extends ManageRecords
{
    protected static string $resource = SiteDownLogResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
