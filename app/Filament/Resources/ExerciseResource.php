<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ExerciseResource\Pages;
use App\Filament\Resources\ExerciseResource\RelationManagers;
use App\Models\Exercise;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
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
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->columnSpanFull()
                    ->rows(3),
                Forms\Components\FileUpload::make('image_path')
                    ->image()
                    ->disk('public')
                    ->directory('exercise_images')
                    ->visibility('public'),
                Forms\Components\TextInput::make('video_url')
                    ->url()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'strength' => 'Strength',
                        'cardio' => 'Cardio',
                        'flexibility' => 'Flexibility',
                        'balance' => 'Balance',
                        'mobility' => 'Mobility',
                    ])
                    ->default('strength')
                    ->native('false')
                    ->required(),
                Forms\Components\Select::make('difficulty')
                    ->options([
                        'beginner' => 'Beginner',
                        'intermediate' => 'Intermediate',
                        'advanced' => 'Advanced',
                    ])
                    ->default('beginner')
                    ->native('false')
                    ->required(),
                Forms\Components\Select::make('equipment')
                    ->options([
                        'bodyweight' => 'Bodyweight',
                        'dumbbell' => 'Dumbbell',
                        'barbell' => 'Barbell',
                        'kettlebell' => 'Kettlebell',
                        'resistance_band' => 'Resistance Band',
                        'none' => 'None',
                    ])
                    ->native('false')
                    ->nullable(),
                Forms\Components\Select::make('primary_muscle_group')
                    ->options([
                        'chest' => 'Chest',
                        'back' => 'Back',
                        'legs' => 'Legs',
                        'arms' => 'Arms',
                        'shoulders' => 'Shoulders',
                        'core' => 'Core',
                    ])
                    ->native('false')
                    ->nullable(),
                Forms\Components\Select::make('secondary_muscle_group')
                    ->options([
                        'chest' => 'Chest',
                        'back' => 'Back',
                        'legs' => 'Legs',
                        'arms' => 'Arms',
                        'shoulders' => 'Shoulders',
                        'core' => 'Core',
                    ])
                    ->native('false')
                    ->nullable(),
                Forms\Components\Textarea::make('instructions')
                    ->columnSpanFull()
                    ->rows(3),
                Forms\Components\TextInput::make('default_sets')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(3),
                Forms\Components\TextInput::make('default_reps')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(10),
                Forms\Components\TextInput::make('default_rest_period')
                    ->required()
                    ->numeric()
                    ->minValue(1)
                    ->default(60),
                Forms\Components\Toggle::make('is_active')
                    ->label('Active')
                    ->inline(false)
                    ->default(true),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('type')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('difficulty')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('equipment')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->boolean(),
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
