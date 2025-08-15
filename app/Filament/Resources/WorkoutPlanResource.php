<?php

namespace App\Filament\Resources;

use App\Filament\Resources\WorkoutPlanResource\Pages;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers\CommentsRelationManager;
use App\Filament\Resources\WorkoutPlanResource\RelationManagers\ItemsRelationManager;
use App\Models\WorkoutPlan;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
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
                Grid::make(3)
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255),
                        Select::make('member_id')
                            ->label('Miembro')
                            ->relationship('member', 'name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->required(),
                        Select::make('trainer_id')
                            ->label('Entrenador')
                            ->relationship('trainer', 'name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->required(),
                    ]),


                Textarea::make('description')
                    ->label('Descripción')
                    ->columnSpanFull()
                    ->rows(3),
                Select::make('status')
                    ->label('Estado')
                    ->options([
                        'draft'     => 'Borrador',
                        'active'    => 'Activo',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado',
                        'archived'  => 'Archivado',
                    ])
                    ->native(false)
                    ->default('draft')
                    ->required(),
                Toggle::make('is_template')
                    ->label('Plantilla')
                    ->default(false),
                DatePicker::make('starts_at')
                    ->label('Fecha de Inicio')
                    ->native('false')
                    ->closeOnDateSelection()
                    ->required()
                    ->default(now()),
                DatePicker::make('ends_at')
                    ->label('Fecha de Fin')
                    ->native('false')
                    ->closeOnDateSelection()
                    ->required()
                    ->default(now()),
                Select::make('repeat_pattern')
                    ->label('Patrón de Repetición')
                    ->options([
                        'daily'    => 'Diario',
                        'weekly'   => 'Semanal',
                        'biweekly' => 'Quincenal',
                        'monthly'  => 'Mensual',
                    ])
                    ->native(false)
                    ->default('weekly')
                    ->required(),
                Textarea::make('notes')
                    ->label('Notas')
                    ->columnSpanFull()
                    ->rows(2)
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'draft'     => 'gray',
                        'active'    => 'primary',
                        'completed' => 'success',
                        'cancelled' => 'danger',
                        'archived'  => 'gray',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'draft'     => 'Borrador',
                        'active'    => 'Activo',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado',
                        'archived'  => 'Archivado',
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('member.name')
                    ->label('Miembro')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('trainer.name')
                    ->label('Entrenador')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('starts_at')
                    ->label('Inicio')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('ends_at')
                    ->label('Fin')
                    ->date('d/m/Y')
                    ->sortable(),
                TextColumn::make('creator.name')
                    ->label('Creador')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->label('Estado')
                    ->options([
                        'draft'     => 'Borrador',
                        'active'    => 'Activo',
                        'completed' => 'Completado',
                        'cancelled' => 'Cancelado',
                        'archived'  => 'Archivado',
                    ])
                    ->native(false),
                SelectFilter::make('member_id')
                    ->label('Miembro')
                    ->relationship('member', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false),
                SelectFilter::make('trainer_id')
                    ->label('Entrenador')
                    ->relationship('trainer', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false),
                SelectFilter::make('creator_id')
                    ->label('Creador')
                    ->relationship('creator', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false),
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
