<?php

namespace App\Filament\Resources\Categories;

use UnitEnum;
use BackedEnum;
use App\Models\Category;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Hexters\HexaLite\HasHexaLite;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Categories\Pages\EditCategory;
use App\Filament\Resources\Categories\Pages\CreateCategory;
use App\Filament\Resources\Categories\Pages\ListCategories;
use App\Filament\Resources\Categories\Schemas\CategoryForm;
use App\Filament\Resources\Categories\Tables\CategoriesTable;

class CategoryResource extends Resource
{
    use HasHexaLite;

    protected static ?string $model = Category::class;
    protected static ?string $navigationLabel = 'دسته بندی ها';
    protected static ?string $pluralModelLabel = 'دسته بندی ها';
    protected static ?string $modelLabel = 'دسته بندی';

    protected static string | UnitEnum | null $navigationGroup = 'محصولات';
    protected static ?int $navigationSort = 1;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleGroup;

    protected static ?string $recordTitleAttribute = 'Category';

    public static function form(Schema $schema): Schema
    {
        return CategoryForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CategoriesTable::configure($table);
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
            'index' => ListCategories::route('/'),
            'create' => CreateCategory::route('/create'),
            'edit' => EditCategory::route('/{record}/edit'),
        ];
    }

    public function defineGates(): array
    {
        return [
            'category.index'  => __('دسترسی مشاهده لیست دسته بندی ها'),
            'category.create' => __('دسترسی ایجاد دسته بندی جدید'),
            'category.update' => __('دسترسی بروزرسانی دسته بندی'),
            'category.delete' => __('دسترسی حذف دسته بندی'),
        ];
    }
}
