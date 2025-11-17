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
                TextInput::make('name')->label('نام و نام خانوادگی'),
                TextInput::make('email')->label('ایمیل'),
                TextInput::make('password')->label('رمز عبور'),
            ]);
    }
}
