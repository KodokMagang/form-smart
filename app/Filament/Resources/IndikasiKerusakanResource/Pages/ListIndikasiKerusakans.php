<?php

namespace App\Filament\Resources\IndikasiKerusakanResource\Pages;

use App\Filament\Resources\IndikasiKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListIndikasiKerusakans extends ListRecords
{
    protected static string $resource = IndikasiKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
