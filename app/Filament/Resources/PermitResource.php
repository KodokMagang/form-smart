<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Permit;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TimePicker;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PermitResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PermitResource\RelationManagers;

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
                //
                Select::make('karyawan_id')->relationship('karyawan', 'nama_karyawan')->label('Nama Karyawan'),
                TextInput::make('keperluan')->label('Keperluan'),
                TimePicker::make('mulai_jam')->label('Mulai Jam'),
                TimePicker::make('sd_jam')->label('Sampai Dengan Jam'),
                DatePicker::make('mulai_tanggal')->label('Mulai Tanggal'),
                DatePicker::make('sd_tanggal')->label('Sampai Dengan Jam'),
                
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('Accept')
                    ->icon('heroicon-m-check')
                    ->requiresConfirmation()
                    ->action(function ($records){
                        return collect($records)->each(function ($record){
                            $id = $record->id;
                            Permit::where('id', $id)->update(['status' => 'accept']);
                        });
                    }),

                    BulkAction::make('Waiting')
                    ->icon('heroicon-m-arrow-path')
                    ->requiresConfirmation()
                    ->action(function ($records){
                        return collect($records)->each->update(['status'=>'waiting']);
                    }),
                
                    BulkAction::make('Reject')
                    ->icon('heroicon-m-x-circle')
                    ->requiresConfirmation()
                    ->action(function ($records){
                        return collect($records)->each(function ($record){
                            $id = $record->id;
                            Permit::where('id', $id)->update(['status' => 'reject']);
                        });
                    }),
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
            'index' => Pages\ListPermits::route('/'),
            'create' => Pages\CreatePermit::route('/create'),
            'edit' => Pages\EditPermit::route('/{record}/edit'),
        ];
    }
}
