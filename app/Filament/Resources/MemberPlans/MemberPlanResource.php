<?php

namespace App\Filament\Resources\MemberPlans;

use App\Filament\Resources\MemberPlans\Pages\CreateMemberPlan;
use App\Filament\Resources\MemberPlans\Pages\EditMemberPlan;
use App\Filament\Resources\MemberPlans\Pages\ListMemberPlans;
use App\Filament\Resources\MemberPlans\Schemas\MemberPlanForm;
use App\Filament\Resources\MemberPlans\Tables\MemberPlansTable;
use App\Models\MemberPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberPlanResource extends Resource
{
    protected static ?string $model = MemberPlan::class;
    protected static ?string $navigationLabel = 'Planes asignados';
    protected static ?string $modelLabel = 'Plan asignado';
    protected static ?string $pluralModelLabel = 'Planes asignados';
    protected static ?int $navigationSort = 1;
    protected static string | UnitEnum | null $navigationGroup = 'Planes';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClipboardDocumentList;

    public static function form(Schema $schema): Schema
    {
        return MemberPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberPlansTable::configure($table);
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
            'index' => ListMemberPlans::route('/'),
            'create' => CreateMemberPlan::route('/create'),
            'edit' => EditMemberPlan::route('/{record}/edit'),
        ];
    }
}
