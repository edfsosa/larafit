<?php

namespace App\Filament\Resources\TrainingPlans;

use App\Filament\Resources\TrainingPlans\Pages\CreateTrainingPlan;
use App\Filament\Resources\TrainingPlans\Pages\EditTrainingPlan;
use App\Filament\Resources\TrainingPlans\Pages\ListTrainingPlans;
use App\Filament\Resources\TrainingPlans\Schemas\TrainingPlanForm;
use App\Filament\Resources\TrainingPlans\Tables\TrainingPlansTable;
use App\Models\TrainingPlan;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class TrainingPlanResource extends Resource
{
    protected static ?string $model = TrainingPlan::class;
    protected static ?string $navigationLabel = 'Planes de entrenamiento';
    protected static ?string $modelLabel = 'Plan de entrenamiento';
    protected static ?string $pluralModelLabel = 'Planes de entrenamiento';
    protected static ?int $navigationSort = 1;
    protected static string | UnitEnum | null $navigationGroup = 'Planes';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return TrainingPlanForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrainingPlansTable::configure($table);
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
            'index' => ListTrainingPlans::route('/'),
            'create' => CreateTrainingPlan::route('/create'),
            'edit' => EditTrainingPlan::route('/{record}/edit'),
        ];
    }
}
