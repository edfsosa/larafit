<?php

namespace App\Filament\Resources\Reviews;

use App\Filament\Resources\Reviews\Pages\ManageReviews;
use App\Models\Member;
use App\Models\MemberPlan;
use App\Models\MemberRoutine;
use App\Models\MemberTrainer;
use App\Models\Review;
use App\Models\Trainer;
use BackedEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Components\MorphToSelect\Type;
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
                MorphToSelect::make('author')
                    ->label('Revisor')
                    ->types([
                        Type::make(Member::class)
                            ->label('Miembro')
                            ->getOptionLabelFromRecordUsing(fn(Member $record): string => $record->user->name),
                        Type::make(Trainer::class)
                            ->label('Entrenador')
                            ->getOptionLabelFromRecordUsing(fn(Trainer $record): string => $record->user->name),
                    ])
                    ->native(false)
                    ->required(),
                MorphToSelect::make('reviewable')
                    ->label('Revisado')
                    ->types([
                        Type::make(MemberPlan::class)
                            ->label('Plan asignado')
                            ->getOptionLabelFromRecordUsing(fn(MemberPlan $record): string => $record->plan->name),
                        Type::make(MemberTrainer::class)
                            ->label('Entrenador asignado')
                            ->getOptionLabelFromRecordUsing(fn(MemberTrainer $record): string => $record->member->user->name),
                    ])
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
                TextColumn::make('author.user.name')
                    ->label('Autor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('reviewable_type')
                    ->label('Revisor')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('rating')
                    ->label('Calificación')
                    ->formatStateUsing(fn(string $state): string => "{$state}/5")
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
