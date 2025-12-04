<?php

namespace App\Filament\Resources\Users;

use UnitEnum;
use BackedEnum;
use App\Models\User;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Hexters\HexaLite\HasHexaLite;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Users\Pages\EditUser;
use App\Filament\Resources\Users\Pages\ListUsers;
use App\Filament\Resources\Users\Pages\CreateUser;
use App\Filament\Resources\Users\Schemas\UserForm;
use App\Filament\Resources\Users\Tables\UsersTable;

class UserResource extends Resource
{
    use HasHexaLite;

    protected static ?string $model = User::class;
    protected static ?string $navigationLabel = 'کاربران';
    protected static ?string $pluralModelLabel = 'کاربران';
    protected static ?string $modelLabel = 'کابر';

    protected static string | UnitEnum | null $navigationGroup = 'تنظیمات';
    protected static ?int $navigationSort = 2;

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedUser;

    protected static ?string $recordTitleAttribute = 'User';

    public static function form(Schema $schema): Schema
    {

        return UserForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return UsersTable::configure($table);
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
            'index' => ListUsers::route('/'),
            'create' => CreateUser::route('/create'),
            'edit' => EditUser::route('/{record}/edit'),
        ];
    }

    public function defineGates(): array
    {
        return [
            'user.index'  => __('دسترسی مشاهده لیست کاربران'),
            'user.create' => __('دسترسی ایجاد کاربر جدید'),
            'user.update' => __('دسترسی بروزرسانی کاربر'),
            'user.delete' => __('دسترسی حذف کاربر'),
        ];
    }
}
