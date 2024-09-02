<?php

namespace App\Filament\Employee\Resources\PerbaikanResource\Pages;

use App\Filament\Employee\Resources\PerbaikanResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPerbaikan extends EditRecord
{
    protected static string $resource = PerbaikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
