<?php

namespace App\Filament\Resources\Reviews;

use App\Filament\Resources\Reviews\Pages\ManageReviews;
use App\Models\MemberRoutine;
use App\Models\Review;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use UnitEnum;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;
    protected static ?string $navigationLabel = 'Reseñas';
    protected static ?string $modelLabel = 'Reseña';
    protected static ?string $pluralModelLabel = 'Reseñas';
    protected static ?int $navigationSort = 6;
    protected static string | UnitEnum | null $navigationGroup = 'Miembros';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('member_routine_id')
                    ->label('Rutina')
                    ->options(function () {
                        return MemberRoutine::with('member', 'routine')
                            ->get()
                            ->mapWithKeys(function ($mr) {
                                return [$mr->id => $mr->member->user->name . ' - ' . $mr->routine->name];
                            })
                            ->toArray();
                    })
                    ->disabled()
                    ->required(),
                Select::make('reviewer_id')
                    ->label('Revisor')
                    ->relationship('reviewer', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                Select::make('reviewed_id')
                    ->label('Revisado')
                    ->relationship('reviewed', 'name')
                    ->preload()
                    ->searchable()
                    ->native(false)
                    ->required(),
                TextInput::make('rating')
                    ->label('Calificación')
                    ->numeric()
                    ->minValue(1)
                    ->maxValue(5)
                    ->step(0.1)
                    ->required(),
                Textarea::make('comment')
                    ->label('Comentario')
                    ->rows(3)
                    ->maxLength(1000)
                    ->nullable()
                    ->columnSpanFull(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                TextColumn::make('memberRoutine.routine.name')
                    ->label('Rutina')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewer.name')
                    ->label('Revisor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewed.name')
                    ->label('Revisado')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('Calificación')
                    ->formatStateUsing(fn (string $state): string => "{$state}/5")
                    ->sortable(),
                TextColumn::make('comment')
                    ->label('Comentario')
                    ->limit(50)
                    ->wrap(),
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
                SelectFilter::make('member_routine_id')
                    ->label('Rutina')
                    ->options(function () {
                        return MemberRoutine::with('member', 'routine')
                            ->get()
                            ->mapWithKeys(function ($mr) {
                                return [$mr->id => $mr->routine->name];
                            })
                            ->toArray();
                    })
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->native(false),
                SelectFilter::make('rating')
                    ->label('Calificación')
                    ->options([
                        1 => '1',
                        2 => '2',
                        3 => '3',
                        4 => '4',
                        5 => '5',
                    ])
                    ->native(false),
                SelectFilter::make('reviewer_id')
                    ->label('Revisor')
                    ->relationship('reviewer', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->native(false),
                SelectFilter::make('reviewed_id')
                    ->label('Revisado')
                    ->relationship('reviewed', 'name')
                    ->preload()
                    ->searchable()
                    ->multiple()
                    ->native(false),
            ])
            ->recordActions([
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => ManageReviews::route('/'),
        ];
    }
}
