<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use App\Models\Perbaikan;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\PerbaikanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PerbaikanResource\RelationManagers;

class PerbaikanResource extends Resource
{
    protected static ?string $model = Perbaikan::class;

    protected static ?string $navigationIcon = 'heroicon-o-wrench-screwdriver';

    protected static ?string $navigationGroup = 'Form'; 

    protected static ?string $navigationLabel = 'Perbaikan';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                Select::make('karyawan_id')->relationship('karyawan', 'nama_karyawan')->label('Nama Karyawan'),
                TextInput::make('merk_noseri')->label('Merk Atau No Seri'),
                TextInput::make('nama_supplier')->label('Nama Supplier'),
                TextInput::make('kontak_supplier')->label('Kontak Supplier'),
                Select::make('indikasi_id')->relationship('indikasi', 'indikasi')->label('Indikasi Kerusakan'),
                TextInput::make('alasan')->label('Alasan Perbaikan'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('karyawan.nama_karyawan')->sortable()->searchable()->label('Nama Karyawan'),
                TextColumn::make('merk_noseri')->sortable()->searchable()->label('Merk/No Seri'),
                TextColumn::make('nama_supplier')->sortable()->searchable()->label('Nama Supplier'),
                TextColumn::make('kontak_supplier')->sortable()->searchable()->label('Kontak Supplier'),
                TextColumn::make('indikasi.indikasi')->sortable()->searchable()->label('Indikasi Kerusakan'),
                TextColumn::make('alasan')->sortable()->searchable()->label('Alasan'),
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
                            Perbaikan::where('id', $id)->update(['status' => 'accept']);
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
                            Perbaikan::where('id', $id)->update(['status' => 'reject']);
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
            'index' => Pages\ListPerbaikans::route('/'),
            'create' => Pages\CreatePerbaikan::route('/create'),
            'edit' => Pages\EditPerbaikan::route('/{record}/edit'),
        ];
    }
}
