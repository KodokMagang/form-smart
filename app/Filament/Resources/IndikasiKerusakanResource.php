<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use App\Models\IndikasiKerusakan;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\IndikasiKerusakanResource\Pages;
use App\Filament\Resources\IndikasiKerusakanResource\RelationManagers;

class IndikasiKerusakanResource extends Resource
{
    protected static ?string $model = IndikasiKerusakan::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-stack';

    protected static ?string $navigationLabel = 'Indikasi Kerusakan';

    protected static ?string $navigationGroup = 'Option Form'; 
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Card::make()
                ->schema([
                    TextInput::make('indikasi')->label('Indikasi Kerusakan'),
                ])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('indikasi')->sortable()->searchable()->label('Indikasi Kerusakan'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListIndikasiKerusakans::route('/'),
            'create' => Pages\CreateIndikasiKerusakan::route('/create'),
            'edit' => Pages\EditIndikasiKerusakan::route('/{record}/edit'),
        ];
    }
}