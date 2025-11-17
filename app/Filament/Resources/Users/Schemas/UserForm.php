<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->label('نام و نام خانوادگی')
                    ->minLength(3),
                TextInput::make('email')
                    ->label('ایمیل')
                    ->email()
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('password')->label('رمز عبور')
                    ->password()
                    ->required(fn(string $context): bool => $context == 'create')
                    ->dehydrated(fn($state) => filled($state))
                    ->minLength(4),
            ]);
    }
}
