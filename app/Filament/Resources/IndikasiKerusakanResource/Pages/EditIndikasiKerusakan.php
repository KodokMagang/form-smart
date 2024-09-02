<?php

namespace App\Filament\Resources\IndikasiKerusakanResource\Pages;

use App\Filament\Resources\IndikasiKerusakanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditIndikasiKerusakan extends EditRecord
{
    protected static string $resource = IndikasiKerusakanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
