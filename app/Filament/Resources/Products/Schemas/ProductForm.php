<?php

namespace App\Filament\Resources\Products\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Select::make('category_id')
                    ->label('انتخاب دسته بندی')
                    ->relationship(
                        'category',
                        'name',
                        fn(Builder $query) => $query->whereNotNull('parent_id')
                    )
                    ->required(),
                TextInput::make('title')
                    ->label('نام محصول')
                    ->required(),
                Textarea::make('description')
                    ->label('توضیحات محصول')
                    ->required()
                    ->columnSpanFull(),
                TextInput::make('price')
                    ->label('قیمت')
                    ->required()
                    ->numeric()
                    ->suffix('تومان'),
                FileUpload::make('image')
                    ->label('تصویر محصول')
                    ->image()
                    ->avatar()
                    ->imageEditor()
                    ->disk('filament')
                    ->directory('products')
                    ->required(),
            ]);
    }
}
