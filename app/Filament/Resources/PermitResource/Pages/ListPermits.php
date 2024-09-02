<?php

namespace App\Filament\Resources\PermitResource\Pages;

use Filament\Actions;
use Filament\Resources\Components\Tab;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PermitResource;

class ListPermits extends ListRecords
{
    protected static string $resource = PermitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Izin';
    }

    public function getTabs(): array
    {
    return [
        'all' => Tab::make(),
        'accept' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'accept')),
        'waiting' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'waiting')),
        'reject' => Tab::make()
            ->modifyQueryUsing(fn (Builder $query) => $query->where('status', 'reject')),
        ];
    }
}
