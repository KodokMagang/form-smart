<?php

namespace App\Filament\Employee\Resources\PerbaikanResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use Illuminate\Database\Eloquent\Builder;
use Filament\Resources\Pages\ListRecords\Tab;
use App\Filament\Employee\Resources\PerbaikanResource;

class ListPerbaikans extends ListRecords
{
    protected static string $resource = PerbaikanResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function getTitle(): string
    {
        return 'Perbaikan';
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
