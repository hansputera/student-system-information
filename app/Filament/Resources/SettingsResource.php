<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SettingsResource\Pages;
use App\Filament\Resources\SettingsResource\RelationManagers;
use App\Models\Settings;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Table;

class SettingsResource extends Resource
{
    protected static ?string $model = Settings::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('setting_name')
                    ->label('Nama Setting')
                    ->required()
                    ->placeholder('Contoh: Pengaturan 1'),

                // Forms\Components\Group::make([
                    Forms\Components\TextInput::make('site_name')
                        ->label('Nama Situs')
                        ->required()
                        ->placeholder('SIS SMA Negeri 3 Palu'),
                    Forms\Components\Textarea::make('site_description')
                        ->label('Deskripsi Situs')
                        ->required()
                        ->placeholder('Contoh: Sistem Informasi Siswa SMA Negeri 3 Palu'),
                // ]),

                Forms\Components\Grid::make(2)
                    ->schema([
                        Forms\Components\TextInput::make('headmaster_name')
                            ->label('Nama Kepala Sekolah')
                            ->required()
                            ->placeholder('Contoh: H. Idris Ade,S.Pd.,M.Si.'),

                        Forms\Components\TextInput::make('headmaster_id')
                            ->label('NIP Kepala Sekolah')
                            ->required()
                            ->placeholder('Contoh: 123456789000'),
                        
                        Forms\Components\TextInput::make('dapodik_webservice')
                            ->label('Dapodik WebService')
                            ->required()
                            ->placeholder('URL Dapodik Anda')
                            ->url(),

                        Forms\Components\TextInput::make('dapodik_webservice_key')
                            ->label('Dapodik WebService Key')
                            ->required()
                            ->placeholder('Key webservice Dapodik Anda'),

                        Forms\Components\TextInput::make('vervalpd_email')
                            ->label('VervalPD Email')
                            ->required()
                            ->placeholder('Contoh: iniemailverval@gmail.com')
                            ->email(),

                        Forms\Components\TextInput::make('vervalpd_password')
                            ->label('VervalPD Password')
                            ->required()
                            ->placeholder('Contoh: iniPa55w0rd@')
                            ->password(),
                    ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('setting_name')
                    ->label('Nama Setting'),
                Tables\Columns\TextColumn::make('site_name')
                    ->label('Nama Site'),
                Tables\Columns\TextColumn::make('site_description')
                    ->label('Deskripsi Site'),
                Tables\Columns\TextColumn::make('dapodik_webservice')
                    ->label('Dapodik WebService'),
                Tables\Columns\TextColumn::make('vervalpd_email')
                    ->label('VervalPd Email'),
                Tables\Columns\IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->size(IconColumn\IconColumnSize::Medium)
                    ->trueIcon('heroicon-o-check-badge')
                    ->falseIcon('heroicon-o-x-mark')->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('toggle')
                    ->label(fn (Settings $record) => $record->active ? 'Deactivate' : 'Activate')
                    ->icon(fn (Settings $record) => $record->active ? 'eos-disabled-by-default' : 'heroicon-c-check')
                    ->color(fn (Settings $record) => $record->active ? 'danger' : 'info')
                    ->action(fn (Settings $record) => $record->update([
                        'active' => !$record->active,
                    ]))
                    ->disabled(function (Settings $record) {
                        $recordActive = $record->whereActive(true);

                        if (!$recordActive->exists()) {
                            return false;
                        }

                        return !$record->active && $recordActive->id !== $record->id;
                    }),
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
            'index' => Pages\ListSettings::route('/'),
            'create' => Pages\CreateSettings::route('/create'),
            'edit' => Pages\EditSettings::route('/{record}/edit'),
        ];
    }
}
