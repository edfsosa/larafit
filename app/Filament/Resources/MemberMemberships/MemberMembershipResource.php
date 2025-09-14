<?php

namespace App\Filament\Resources\MemberMemberships;

use App\Filament\Resources\MemberMemberships\Pages\CreateMemberMembership;
use App\Filament\Resources\MemberMemberships\Pages\EditMemberMembership;
use App\Filament\Resources\MemberMemberships\Pages\ListMemberMemberships;
use App\Filament\Resources\MemberMemberships\Schemas\MemberMembershipForm;
use App\Filament\Resources\MemberMemberships\Tables\MemberMembershipsTable;
use App\Models\MemberMembership;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class MemberMembershipResource extends Resource
{
    protected static ?string $model = MemberMembership::class;
    protected static ?string $navigationLabel = 'Membresías';
    protected static ?string $modelLabel = 'Membresía';
    protected static ?string $pluralModelLabel = 'Membresías';
    protected static ?int $navigationSort = 2;
    protected static string | UnitEnum| null $navigationGroup = 'Miembros';
    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedIdentification;

    public static function form(Schema $schema): Schema
    {
        return MemberMembershipForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return MemberMembershipsTable::configure($table);
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
            'index' => ListMemberMemberships::route('/'),
            'create' => CreateMemberMembership::route('/create'),
            'edit' => EditMemberMembership::route('/{record}/edit'),
        ];
    }
}
