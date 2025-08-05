<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutPlanResource\Pages;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers\ItemsRelationManager;
use App\Models\WorkoutPlan;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class WorkoutPlanResource extends Resource
{
    protected static ?string $model = WorkoutPlan::class;
    protected static ?string $navigationIcon = 'heroicon-o-clipboard-document-list';
    protected static ?string $label = 'Plan de Entrenamiento';
    protected static ?string $pluralLabel = 'Planes de Entrenamiento';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('member_id')
                    ->relationship('member', 'id')
                    ->required(),
                Forms\Components\Select::make('trainer_id')
                    ->relationship('trainer', 'name'),
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(3),
                Forms\Components\Select::make('status')
                    ->options([
                        'draft'     => 'Draft',
                        'active'    => 'Active',
                        'completed' => 'Completed',
                        'cancelled' => 'Cancelled',
                        'archived'  => 'Archived',
                    ])
                    ->default('draft')
                    ->required(),
                Forms\Components\Toggle::make('is_template')
                    ->label('Template')
                    ->default(false),
                Forms\Components\DatePicker::make('starts_at')
                    ->native('false')
                    ->required()
                    ->default(now()),
                Forms\Components\DatePicker::make('ends_at')
                    ->native('false')
                    ->required()
                    ->default(now()),
                Forms\Components\Select::make('repeat_pattern')
                    ->options([
                        'daily'    => 'Daily',
                        'weekly'   => 'Weekly',
                        'biweekly' => 'Biweekly',
                        'monthly'  => 'Monthly',
                    ])
                    ->default('weekly'),
                Forms\Components\Textarea::make('notes')
                    ->columnSpanFull()
                    ->rows(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('title')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft'     => 'gray',
                        'active'    => 'green',
                        'completed' => 'blue',
                        'cancelled' => 'red',
                        'archived'  => 'yellow',
                    }),
                Tables\Columns\IconColumn::make('is_template')
                    ->label('Template')
                    ->boolean(),
                Tables\Columns\TextColumn::make('starts_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ends_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            ItemsRelationManager::class,
            CommentsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListWorkoutPlans::route('/'),
            'create' => Pages\CreateWorkoutPlan::route('/create'),
            'edit' => Pages\EditWorkoutPlan::route('/{record}/edit'),
        ];
    }
}
