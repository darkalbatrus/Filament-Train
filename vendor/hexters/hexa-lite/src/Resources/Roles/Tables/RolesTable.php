<?php

namespace Hexters\HexaLite\Resources\Roles\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{
    public static function configure(Table $table): Table 
    {
        return $table
            ->modifyQueryUsing(fn($query) => $query->where('guard', hexa()->guard()))
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->label(__('نام نقش')),
                TextColumn::make('created_by_name')
                    ->searchable()
                    ->label(__('سازنده')),
                TextColumn::make('created_at')
                    ->sortable()
                    ->dateTime('d/m/y H:i')
                    ->label('زمان ساخت'),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make()
                    ->button()
                    ->visible(fn() => hexa()->can('role.update')),
                DeleteAction::make()
                    ->button()
                    ->visible(fn() => hexa()->can('role.delete')),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make()
                        ->visible(fn() => hexa()->can('role.delete')),
                ]),
            ]);
    }
}
