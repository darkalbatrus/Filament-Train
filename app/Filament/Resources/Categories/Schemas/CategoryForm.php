<?php

namespace App\Filament\Resources\Categories\Schemas;

use Illuminate\Support\Str;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use Filament\Schemas\Components\Utilities\Set;

class CategoryForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('parent_id')
                    ->relationship(
                        'parent',
                        'name',
                        fn(Builder $query) => $query->whereNull('parent_id')
                    )
                    ->searchable()
                    ->placeholder('دسته بندی اصلی')
                    ->preload()
                    ->default(null)
                    ->label('دسته بندی اصلی'),
                TextInput::make('name')
                    ->required()
                    ->label('نام دسته بندی'),
                    // ->live()
                    // ->afterStateUpdated(function (Set $set, $state) {
                    //     $set('slug', Str::slug($state));
                    // }),
                // TextInput::make('slug')
                //     ->required(),
            ]);
    }
}
