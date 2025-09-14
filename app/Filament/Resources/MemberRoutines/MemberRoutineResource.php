<?php

namespace App\Filament\Resources\MemberRoutines;

use App\Filament\Resources\MemberRoutines\Pages\CreateMemberRoutine;
use App\Filament\Resources\MemberRoutines\Pages\EditMemberRoutine;
use App\Filament\Resources\MemberRoutines\Pages\ListMemberRoutines;
use App\Filament\Resources\MemberRoutines\Schemas\MemberRoutineForm;
use App\Filament\Resources\MemberRoutines\Tables\MemberRoutinesTable;
use App\Models\MemberRoutine;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberRoutineResource extends Resource
{
    protected static ?string $model = MemberRoutine::class;
    protected static ?string $navigationLabel = 'Rutinas asignadas';
    protected static ?string $modelLabel = 'Rutina asignada';
    protected static ?string $pluralModelLabel = 'Rutinas asignadas';
    protected static ?int $navigationSort = 1;
    protected static string | UnitEnum| null $navigationGroup = 'Rutinas';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return MemberRoutineForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberRoutinesTable::configure($table);
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
            'index' => ListMemberRoutines::route('/'),
            'create' => CreateMemberRoutine::route('/create'),
            'edit' => EditMemberRoutine::route('/{record}/edit'),
        ];
    }
}
