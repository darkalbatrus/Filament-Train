<?php

namespace App\Filament\Resources\Products;

use UnitEnum;
use BackedEnum;
use App\Models\Product;
use Filament\Tables\Table;
use Filament\Schemas\Schema;
use Filament\Resources\Resource;
use Hexters\HexaLite\HasHexaLite;
use Filament\Support\Icons\Heroicon;
use App\Filament\Resources\Products\Pages\EditProduct;
use App\Filament\Resources\Products\Pages\ListProducts;
use App\Filament\Resources\Products\Pages\CreateProduct;
use App\Filament\Resources\Products\Schemas\ProductForm;
use App\Filament\Resources\Products\Tables\ProductsTable;

class ProductResource extends Resource
{
    use HasHexaLite;

    protected static ?string $model = Product::class;
    protected static ?string $navigationLabel = 'محصولات';
    protected static ?string $pluralModelLabel = 'محصولات';
    protected static ?string $modelLabel = 'محصول';

    protected static string | UnitEnum | null $navigationGroup = 'محصولات';
    protected static ?int $navigationSort = 2;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedArchiveBox;

    protected static ?string $recordTitleAttribute = 'Product';

    public static function form(Schema $schema): Schema
    {
        return ProductForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ProductsTable::configure($table);
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
            'index' => ListProducts::route('/'),
            'create' => CreateProduct::route('/create'),
            'edit' => EditProduct::route('/{record}/edit'),
        ];
    }

    public function defineGates(): array
    {
        return [
            'product.index'  => __('دسترسی مشاهده لیست محصولات'),
            'product.create' => __('دسترسی ایجاد محصول جدید'),
            'product.update' => __('دسترسی بروزرسانی محصول'),
            'product.delete' => __('دسترسی حذف محصول'),
        ];
    }

    public static function canAccess(): bool
    {
        return hexa()->can('product.index');
    }
}
