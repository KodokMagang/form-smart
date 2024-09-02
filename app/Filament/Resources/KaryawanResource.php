<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Karyawan;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Tables\Actions\EditAction;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use App\Filament\Resources\KaryawanResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\KaryawanResource\RelationManagers;
use App\Filament\Resources\KaryawanResource\Pages\EditKaryawan;
use App\Filament\Resources\KaryawanResource\Pages\ListKaryawans;
use App\Filament\Resources\KaryawanResource\Pages\CreateKaryawan;

class KaryawanResource extends Resource
{
    protected static ?string $model = Karyawan::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'Adminstrasi';

    protected static ?string $navigationLabel = 'Daftar Karyawan';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
                TextInput::make('nik_karyawan')->label('NIK'),
                TextInput::make('nama_karyawan')->label('Nama Karyawan'),
                TextInput::make('tempat_lahir')->label('Tempat Lahir'),
                DatePicker::make('tanggal_lahir')->label('Tanggal Lahir'),
                Select::make('role_id')->relationship('roles', 'name'),
                Select::make('divisi_id')->relationship('divisi', 'nama_divisi')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
                TextColumn::make('nik_karyawan')->sortable()->searchable()->label('NIK'),
                TextColumn::make('nama_karyawan')->sortable()->searchable()->label('Nama Karyawan'),
                TextColumn::make('tempat_lahir')->sortable()->searchable()->label('Tempat Lahir'),
                TextColumn::make('tanggal_lahir')->date()->sortable()->searchable()->label('Tanggal Lahir'),
                TextColumn::make('roles.name')->sortable()->searchable()->label('Role'),
                TextColumn::make('divisi.nama_divisi')->sortable()->searchable()->label('Divisi'),
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
            'index' => Pages\ListKaryawans::route('/'),
            'create' => Pages\CreateKaryawan::route('/create'),
            'edit' => Pages\EditKaryawan::route('/{record}/edit'),
        ];
    }
}
