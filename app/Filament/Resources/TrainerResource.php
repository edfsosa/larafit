<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TrainerResource\Pages;
use App\Filament\Resources\TrainerResource\RelationManagers;
use App\Models\Trainer;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Radio;
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

class TrainerResource extends Resource
{
    protected static ?string $model = Trainer::class;
    protected static ?string $navigationIcon = 'heroicon-o-user-circle';
    protected static ?string $label = 'Entrenador';
    protected static ?string $pluralLabel = 'Entrenadores';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('document_number')
                    ->label('Documento')
                    ->integer()
                    ->minValue(1)
                    ->unique(Trainer::class, 'document_number')
                    ->required(),
                TextInput::make('name')
                    ->label('Nombre Completo')
                    ->required()
                    ->maxLength(255),
                DatePicker::make('birthdate')
                    ->label('Fecha de Nacimiento')
                    ->native(false)
                    ->default(now())
                    ->minDate(now()->subYears(100))
                    ->required(),
                Radio::make('gender')
                    ->label('Género')
                    ->options([
                        'male' => 'Masculino',
                        'female' => 'Femenino',
                    ])
                    ->inline()
                    ->inlineLabel(false)
                    ->required(),
                FileUpload::make('photo_path')
                    ->label('Foto')
                    ->image()
                    ->disk('public')
                    ->directory('trainer-photos')
                    ->nullable()
                    ->downloadable()
                    ->columnSpanFull(),
                TextInput::make('phone')
                    ->label('Teléfono')
                    ->tel()
                    ->required()
                    ->maxLength(20),
                TextInput::make('email')
                    ->label('Correo Electrónico')
                    ->email()
                    ->required(),
                Select::make('specialty')
                    ->label('Especialidad')
                    ->options([
                        'strength_training' => 'Entrenamiento de Fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'Crossfit',
                        'other' => 'Otro',
                    ])
                    ->native(false)
                    ->required(),
                Textarea::make('bio')
                    ->label('Biografía')
                    ->rows(3)
                    ->maxLength(1000)
                    ->columnSpanFull()
                    ->nullable(),
                TextInput::make('rating')
                    ->label('Calificación')
                    ->numeric()
                    ->readonly(),
                Toggle::make('is_active')
                    ->label('Activo')
                    ->inline(false)
                    ->default(true)
                    ->hiddenOn('create')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo_path')
                    ->label('Foto'),
                TextColumn::make('document_number')
                    ->label('Documento')
                    ->numeric()
                    ->copyable()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('name')
                    ->label('Nombre')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('phone')
                    ->label('Teléfono')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Correo Electrónico')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('specialty')
                    ->label('Especialidad')
                    ->formatStateUsing(fn($state) => match ($state) {
                        'strength_training' => 'Entrenamiento de Fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'Crossfit',
                        'other' => 'Otro',
                    })
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
                TernaryFilter::make('is_active')
                    ->label('Activo')
                    ->nullable()
                    ->placeholder('Todos')
                    ->trueLabel('Sí')
                    ->falseLabel('No')
                    ->native(false),
                SelectFilter::make('specialty')
                    ->label('Especialidad')
                    ->options([
                        'strength_training' => 'Entrenamiento de Fuerza',
                        'cardio' => 'Cardio',
                        'yoga' => 'Yoga',
                        'pilates' => 'Pilates',
                        'nutrition' => 'Nutrición',
                        'crossfit' => 'Crossfit',
                        'other' => 'Otro',
                    ])
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrainers::route('/'),
            'create' => Pages\CreateTrainer::route('/create'),
            'edit' => Pages\EditTrainer::route('/{record}/edit'),
        ];
    }
}
