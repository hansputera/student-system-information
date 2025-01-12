<?php

namespace App\Filament\Resources\OperatorResource\Pages;

use App\Filament\Resources\OperatorResource;
use App\Models\Operator;
use Filament\Actions;
use Filament\Actions\Action;
use Filament\Resources\Pages\EditRecord;

class EditOperator extends EditRecord
{
    protected static string $resource = OperatorResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
            Actions\Action::make('toggle')
                ->action(fn (Operator $record) => $record->update([
                    'active' => !$record->active,
                ]))
                ->label(fn (Operator $record): string => $record->active ? 'Deactivate' : 'Activate')
                ->icon(fn (Operator $record) => $record->active ? 'heroicon-c-x-mark' : 'heroicon-c-check')
                ->color(fn (Operator $record) => $record->active ? 'warning' : 'success'),
        ];
    }
}
