<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Spatie\Permission\Models\Role;
class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                ->label(__('Name'))
                ->required()
                ->maxLength(255),

    TextInput::make('username')
        ->required()
        ->unique(ignoreRecord: true),

   

TextInput::make('email')
    ->label(__('Email'))
    ->email()
    ->required()
    ->maxLength(255),
    TextInput::make('password')
    ->label(__('Password'))
    ->password()
->required(fn (string $operation): bool => $operation === 'create')
    ->maxLength(255)
    ->revealable(),
    Select::make('role')
    ->label(__('Role'))
    ->options(Role::pluck('name', 'name'))
    ->required()
            ]);
    }
}
