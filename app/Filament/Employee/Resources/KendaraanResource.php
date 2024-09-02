<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Kendaraan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\KendaraanResource\Pages;
use App\Filament\Employee\Resources\KendaraanResource\RelationManagers;

class KendaraanResource extends Resource
{
    protected static ?string $model = Kendaraan::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';

    protected static ?string $navigationGroup = 'Form'; 

    protected static ?string $navigationLabel = 'Kendaraan';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('karyawan_id')->relationship('karyawan', 'nama_karyawan')->label('Nama Karyawan'),
                DatePicker::make('tanggal')->label('Tanggal'),
                TimePicker::make('jam')->label('Jam'),
                TextInput::make('tempat_tujuan')->label('Tempat Tujuan'),
                TextInput::make('keperluan')->label('Keperluan'),
                Select::make('driver_id')
                ->relationship('driver', 'nama_driver')
                ->label('Nama Driver')
                ->hidden(!static::canEditVehicleAndDriverFields()),
            Select::make('vehicle_id')
                ->relationship('vehicle', 'no_polisi')
                ->label('No Polisi')
                ->hidden(!static::canEditVehicleAndDriverFields()),
            ]);
    }

    protected static function canEditVehicleAndDriverFields(): bool
    {
        return auth()->user()->hasAnyRole(['Admin', 'Manager', 'Head Section', 'Staff']);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('karyawan.nama_karyawan')->label('Nama Karyawan'),
                TextColumn::make('tanggal')->sortable()->searchable()->label('Tanggal'),
                TextColumn::make('jam')->sortable()->searchable()->label('Jam'),
                TextColumn::make('tempat_tujuan')->sortable()->searchable()->label('Tempat Tujuan'),
                TextColumn::make('keperluan')->sortable()->searchable()->label('Keperluan'),
                TextColumn::make('driver.nama_driver')->label('Nama Driver'),
                TextColumn::make('vehicle.no_polisi')->label('No Polisi'),
                TextColumn::make('status')->formatStateUsing(fn (string $state): string=> ucwords("{$state}"))->searchable()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                
            ])
            ->bulkActions([
                
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
            'index' => Pages\ListKendaraans::route('/'),
            'create' => Pages\CreateKendaraan::route('/create'),
        ];
    }
}
