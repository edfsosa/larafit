<?php

namespace App\Filament\Resources\ClassActivityResource\Pages;

use App\Filament\Resources\ClassActivityResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClassActivity extends EditRecord
{
    protected static string $resource = ClassActivityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
