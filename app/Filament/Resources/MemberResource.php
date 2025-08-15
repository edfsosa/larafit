<?php

namespace App\Filament\Resources;

use App\Filament\Resources\MemberResource\Pages;
use App\Filament\Resources\MemberResource\RelationManagers;
use App\Models\Member;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
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

class MemberResource extends Resource
{
    protected static ?string $model = Member::class;
    protected static ?string $navigationIcon = 'heroicon-o-user';
    protected static ?string $label = 'Miembro';
    protected static ?string $pluralLabel = 'Miembros';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Información Personal')
                    ->schema([
                        Forms\Components\TextInput::make('document_number')
                            ->label('Documento')
                            ->numeric()
                            ->integer()
                            ->minValue(1)
                            ->unique(Member::class, 'document_number', ignorable: fn(?Member $record) => $record)
                            ->required(),
                        TextInput::make('name')
                            ->label('Nombre Completo')
                            ->maxLength(255)
                            ->required(),
                        DatePicker::make('birthdate')
                            ->label('Fecha de Nacimiento')
                            ->native(false)
                            ->closeOnDateSelection()
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
                            ->directory('member-photos')
                            ->nullable()
                            ->downloadable()
                            ->columnSpanFull(),
                    ])
                    ->columns(4),
                Section::make('Información de Contacto')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Teléfono')
                            ->tel()
                            ->required()
                            ->maxLength(20),
                        TextInput::make('email')
                            ->label('Correo Electrónico')
                            ->email()
                            ->required(),
                        TextInput::make('address')
                            ->label('Dirección')
                            ->maxLength(255),
                        TextInput::make('city')
                            ->label('Ciudad')
                            ->maxLength(100),
                        TextInput::make('emergency_contact_name')
                            ->label('Nombre del Contacto de Emergencia')
                            ->maxLength(100),
                        TextInput::make('emergency_contact_phone')
                            ->label('Teléfono del Contacto de Emergencia')
                            ->tel()
                            ->maxLength(20),
                    ])
                    ->columns(3),
                Section::make('Información Física')
                    ->schema([
                        TextInput::make('height_cm')
                            ->label('Altura (cm)')
                            ->integer()
                            ->minValue(30)
                            ->maxValue(300)
                            ->step(1),
                        TextInput::make('weight_kg')
                            ->label('Peso (kg)')
                            ->numeric()
                            ->minValue(1)
                            ->maxValue(500)
                            ->step(0.1),
                    ])
                    ->columns(2),

                Section::make('Información de Membresía')
                    ->schema([
                        Repeater::make('memberships')
                            ->relationship()
                            ->label('Membresías')
                            ->columns(3)
                            ->schema([
                                Select::make('membership_type_id')
                                    ->label('Tipo de Membresía')
                                    ->relationship('membershipType', 'name')
                                    ->native(false)
                                    ->preload()
                                    ->searchable()
                                    ->required(),
                                DatePicker::make('start_date')
                                    ->label('Fecha de Inicio')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->required(),
                                DatePicker::make('end_date')
                                    ->label('Fecha de Fin')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->required(),
                            ]),
                        Grid::make(2)
                            ->schema([
                                TextInput::make('rating')
                                    ->label('Calificación')
                                    ->numeric()
                                    ->readonly(),
                                DatePicker::make('joined_at')
                                    ->label('Fecha de Ingreso')
                                    ->native(false)
                                    ->closeOnDateSelection()
                                    ->displayFormat('d/m/Y')
                                    ->default(now())
                                    ->required(),
                                Toggle::make('active')
                                    ->label('Activo')
                                    ->inline(false)
                                    ->default(true)
                                    ->hiddenOn('create')
                                    ->required(),
                            ])
                    ])
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
                TextColumn::make('joined_at')
                    ->label('Fecha de Ingreso')
                    ->date()
                    ->sortable(),
                IconColumn::make('active')
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
                TernaryFilter::make('active')
                    ->label('Activo')
                    ->nullable()
                    ->placeholder('Todos')
                    ->trueLabel('Sí')
                    ->falseLabel('No')
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
            'index' => Pages\ListMembers::route('/'),
            'create' => Pages\CreateMember::route('/create'),
            'edit' => Pages\EditMember::route('/{record}/edit'),
        ];
    }
}
