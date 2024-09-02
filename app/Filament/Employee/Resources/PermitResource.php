<?php

namespace App\Filament\Employee\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Permit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Employee\Resources\PermitResource\Pages;
use App\Filament\Resources\PermitResource\Pages\EditPermit;
use App\Filament\Resources\PermitResource\Pages\CreatePermit;
use App\Filament\Employee\Resources\PermitResource\RelationManagers;
use App\Filament\Employee\Resources\PermitResource\Pages\ListPermits;

class PermitResource extends Resource
{
    protected static ?string $model = Permit::class;

    protected static ?string $navigationIcon = 'heroicon-o-inbox-arrow-down';

    protected static ?string $navigationGroup = 'Form'; 

    protected static ?string $navigationLabel = 'Izin';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('employee_id')->relationship('employee', 'nama_karyawan')->label('Nama Karyawan'),
                TextInput::make('keperluan')->label('Keperluan'),
                TimePicker::make('mulai_jam')->label('Mulai Jam'),
                TimePicker::make('sd_jam')->label('Sampai Dengan Jam'),
                DatePicker::make('mulai_tanggal')->label('Mulai Tanggal'),
                DatePicker::make('sd_tanggal')->label('Sampai Dengan Tanggal')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                
                TextColumn::make('karyawan.nama_karyawan')->sortable()->searchable()->label('Nama Karyawan'),
                TextColumn::make('keperluan')->sortable()->searchable()->label('Keperluan'),
                TextColumn::make('mulai_jam')->sortable()->searchable()->label('Mulai Jam'),
                TextColumn::make('sd_jam')->sortable()->searchable()->label('Sampai Dengan Jam'),
                TextColumn::make('mulai_tanggal')->sortable()->searchable()->label('Mulai Tanggal'),
                TextColumn::make('sd_tanggal')->sortable()->searchable()->label('Sampai Dengan Tanggal'),
                TextColumn::make('status')->formatStateUsing(fn (string $state): string=> ucwords("{$state}"))->searchable()->sortable(),

            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                //     Tables\Actions\DeleteBulkAction::make(),
                // ]),
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
            'index' => Pages\ListPermits::route('/'),
            'create' => Pages\CreatePermit::route('/create'),
        ];
    }
}
