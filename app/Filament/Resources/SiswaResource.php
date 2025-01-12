<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SiswaResource\Pages;
use App\Models\Siswa;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;

class SiswaResource extends Resource
{
    protected static ?string $title = 'Siswa';
    protected static ?string $navigationLabel = 'Siswa';
    
    protected static ?string $model = Siswa::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Nama Siswa')
                    ->required(true)
                    ->maxLength(100)
                    ->placeholder('Contoh: HANIF DWY PUTRA S.'),
                Forms\Components\TextInput::make('nik')
                    ->label('Nomor Induk Kependudukan')
                    ->required(true)
                    ->unique()
                    ->placeholder('Contoh: 006417281927182'),
                Forms\Components\TextInput::make('nisn')
                    ->label('Nomor Induk Siswa Nasional')
                    ->required(true)
                    ->unique()
                    ->placeholder('Contoh: 0074540906'),
                Forms\Components\TextInput::make('nis')
                    ->label('Nomor Induk Siswa')
                    ->required(true)
                    ->unique()
                    ->placeholder('Contoh: 15919'),
                Forms\Components\DatePicker::make('birth')
                    ->label('Tanggal Lahir')
                    ->required(true)
                    ->maxDate(Carbon::now()->subYear(4)),
                Forms\Components\TextInput::make('birth_place')
                    ->label('Tempat Lahir')
                    ->required(true)
                    ->placeholder('Contoh: Palu')
                    ->maxLength(100),
                Forms\Components\TextInput::make('phone')
                    ->label('Nomor Telepon Aktif')
                    ->required(true)
                    ->integer(),
                Forms\Components\Select::make('religion')
                    ->label('Agama')
                    ->required(true)
                    ->options([
                        'islam' => 'Islam',
                        'kristen' => 'Kristen',
                        'katolik' => 'Katolik',
                        'hindu' => 'Hindu',
                        'buddha' => 'Buddha',
                        'konghucu' => 'Konghucu',
                    ]),
                Forms\Components\TextInput::make('mother_name')
                    ->label('Nama Ibu Kandung')
                    ->required(true)
                    ->placeholder('Contoh: Sukinem'),
                Forms\Components\Select::make('grade_level')
                    ->label('Level Kelas')
                    ->options([
                        10 => 'Kelas 10',
                        11 => 'Kelas 11',
                        12 => 'Kelas 12',
                    ])->required(true),
                Forms\Components\TextInput::make('grade')
                    ->label('Kelas')
                    ->required(true)
                    ->maxLength(50)
                    ->placeholder('Contoh: IPA 7'),
                Forms\Components\FileUpload::make('photo_url')
                    ->label('Foto Pas (3x4)')
                    ->required(false)
                    ->image()
                    ->imageEditor()
                    ->imageEditorMode(2)
                    ->maxSize(2056)
                    ->minSize(256)
                    ->minFiles(1)
                    ->maxFiles(1)
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListSiswas::route('/'),
            'create' => Pages\CreateSiswa::route('/create'),
            'edit' => Pages\EditSiswa::route('/{record}/edit'),
        ];
    }
}
