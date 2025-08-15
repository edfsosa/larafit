<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ExerciseResource extends Resource
{
    protected static ?string $model = Exercise::class;
    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $label = 'Ejercicio';
    protected static ?string $pluralLabel = 'Ejercicios';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('name')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),
                Textarea::make('description')
                    ->label('Descripción')
                    ->rows(1)
                    ->maxLength(1000),
                Grid::make(3)
                    ->schema([
                        Select::make('type')
                            ->label('Tipo')
                            ->options([
                                'strength' => 'Fortaleza',
                                'cardio' => 'Cardio',
                                'flexibility' => 'Flexibilidad',
                                'balance' => 'Equilibrio',
                                'mobility' => 'Movilidad',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('difficulty')
                            ->label('Dificultad')
                            ->options([
                                'beginner' => 'Principiante',
                                'intermediate' => 'Intermedio',
                                'advanced' => 'Avanzado',
                            ])
                            ->native(false)
                            ->required(),
                        Select::make('equipment_id')
                            ->label('Equipo')
                            ->relationship('equipment', 'name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->nullable(),
                    ]),
                FileUpload::make('image_path')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->disk('public')
                    ->directory('exercises/images')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->maxSize(1024)
                    ->acceptedFileTypes(['image/*'])
                    ->downloadable()
                    ->imageCropAspectRatio('1:1')
                    ->columnSpanFull(),
                Grid::make(3)
                    ->schema([
                        TextInput::make('video_url')
                            ->label('Video URL')
                            ->url()
                            ->maxLength(255),
                        Select::make('muscle_group_id')
                            ->label('Grupo Muscular')
                            ->relationship('muscleGroup', 'name')
                            ->preload()
                            ->searchable()
                            ->native(false)
                            ->required(),
                        TextInput::make('default_sets')
                            ->label('Series')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(3),
                        TextInput::make('default_reps')
                            ->label('Repeticiones')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(10),
                        TextInput::make('default_rest_period')
                            ->label('Período de Descanso (segundos)')
                            ->required()
                            ->numeric()
                            ->minValue(1)
                            ->default(60),
                    ]),
                Toggle::make('is_active')
                    ->label('Active')
                    ->inline(false)
                    ->default(true)
                    ->hiddenOn('create'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Imagen')
                    ->circular(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('type')
                    ->label('Tipo')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'strength' => 'Fortaleza',
                        'cardio' => 'Cardio',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                        default => 'Desconocido',
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('difficulty')
                    ->label('Dificultad')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'beginner' => 'Principiante',
                        'intermediate' => 'Intermedio',
                        'advanced' => 'Avanzado',
                        default => 'Desconocido',
                    })
                    ->sortable()
                    ->searchable(),
                TextColumn::make('equipment.name')
                    ->label('Equipo')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('muscleGroup.name')
                    ->label('Grupo Muscular')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean(),
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
                SelectFilter::make('type')
                    ->label('Tipo')
                    ->options([
                        'strength' => 'Fortaleza',
                        'cardio' => 'Cardio',
                        'flexibility' => 'Flexibilidad',
                        'balance' => 'Equilibrio',
                        'mobility' => 'Movilidad',
                    ])
                    ->native(false),
                SelectFilter::make('difficulty')
                    ->label('Dificultad')
                    ->options([
                        'beginner' => 'Principiante',
                        'intermediate' => 'Intermedio',
                        'advanced' => 'Avanzado',
                    ])
                    ->native(false),
                SelectFilter::make('equipment_id')
                    ->label('Equipo')
                    ->relationship('equipment', 'name')
                    ->native(false),
                SelectFilter::make('muscle_group_id')
                    ->label('Grupo Muscular')
                    ->relationship('muscleGroup', 'name')
                    ->native(false),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('video_url')
                    ->label('Ver Video')
                    ->icon('heroicon-o-play-circle')
                    ->url(fn(Exercise $record): string => $record->video_url ?? '')
                    ->openUrlInNewTab()
                    ->visible(fn(Exercise $record): bool => !empty($record->video_url)),
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
            'index' => Pages\ListExercises::route('/'),
            'create' => Pages\CreateExercise::route('/create'),
            'edit' => Pages\EditExercise::route('/{record}/edit'),
        ];
    }
}
