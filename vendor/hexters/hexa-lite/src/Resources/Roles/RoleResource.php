<?php

namespace Hexters\HexaLite\Resources\Roles;

use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Hexters\HexaLite\HasHexaLite;
use Hexters\HexaLite\Models\HexaRole;
use Hexters\HexaLite\Resources\Roles\Pages\CreateRole;
use Hexters\HexaLite\Resources\Roles\Pages\EditRole;
use Hexters\HexaLite\Resources\Roles\Pages\ListRoles;
use Hexters\HexaLite\Resources\Roles\Schemas\RoleForm;
use Hexters\HexaLite\Resources\Roles\Tables\RolesTable;

class RoleResource extends Resource
{
    use HasHexaLite;

    public static function getModel(): string
    {
        return config('hexa.models.role', HexaRole::class);
    }

    protected static bool $shouldRegisterNavigation = false;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedLockClosed;

    public function roleDescription()
    {
        return __('Control user access by managing roles and their permissions.');
    }

    public function defineGates()
    {
        return [
            'role.index' => __('دسترسی مشاهده نقش ها و مجوز ها'),
            'role.create' => __('دسترسی ایجاد نقش و مجوز جدید'),
            'role.update' => __('دسترسی بروزرسانی نقش و مجوز'),
            'role.delete' => __('دسترسی حذف نقش و مجوز'),
        ];
    }

    public function defineGateDescriptions()
    {
        return [
            'role.index' => __('Allows administrators to access and view roles and permissions'),
            'role.create' => __('Allows administrators to create new roles and permissions'),
            'role.update' => __('Allows administrators to modify existing roles and permissions'),
            'role.delete' => __('Allows administrators to delete roles and permissions'),
        ];
    }

    public static function canAccess(): bool
    {
        return hexa()->can('role.index');
    }

    public static function getModelLabel(): string
    {
        return __('نقش و مجوزها');
    }

    public static function form(Schema $schema): Schema
    {
        return RoleForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return RolesTable::configure($table);
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
            'index' => ListRoles::route('/'),
            'create' => CreateRole::route('/create'),
            'edit' => EditRole::route('/{record}/edit'),
        ];
    }
}
