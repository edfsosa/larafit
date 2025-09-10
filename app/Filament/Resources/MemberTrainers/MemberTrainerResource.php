<?php

namespace App\Filament\Resources\MemberTrainers;

use App\Filament\Resources\MemberTrainers\Pages\CreateMemberTrainer;
use App\Filament\Resources\MemberTrainers\Pages\EditMemberTrainer;
use App\Filament\Resources\MemberTrainers\Pages\ListMemberTrainers;
use App\Filament\Resources\MemberTrainers\Schemas\MemberTrainerForm;
use App\Filament\Resources\MemberTrainers\Tables\MemberTrainersTable;
use App\Models\MemberTrainer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class MemberTrainerResource extends Resource
{
    protected static ?string $model = MemberTrainer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return MemberTrainerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberTrainersTable::configure($table);
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
            'index' => ListMemberTrainers::route('/'),
            'create' => CreateMemberTrainer::route('/create'),
            'edit' => EditMemberTrainer::route('/{record}/edit'),
        ];
    }
}
