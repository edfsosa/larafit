<?php

namespace App\Filament\Resources\Users\Pages;

use App\Filament\Resources\Users\UserResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Database\Eloquent\Builder;

class ListUsers extends ListRecords
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }

    public function getTabs(): array
    {
        return [
            'all' => Tab::make()
                ->label('Todos'),
            'admins' => Tab::make()
                ->label('Administradores')
                ->modifyQueryUsing(fn (Builder $query) => $query->role('admin')),
            'members' => Tab::make()
                ->label('Miembros')
                ->modifyQueryUsing(fn (Builder $query) => $query->role('miembro')),
            'trainers' => Tab::make()
                ->label('Entrenadores')
                ->modifyQueryUsing(fn (Builder $query) => $query->role('entrenador')),
        ];
    }
}
