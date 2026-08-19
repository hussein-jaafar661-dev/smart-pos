<?php

namespace App\Filament\Resources\Units\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Modules\Inventory\Enums\UnitType;
use Modules\Company\Models\Company;

class UnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('scope')
                    ->label(__('Unit Scope'))
                    ->options([
                        'system' => __('System Unit'),
                        'company' => __('Company Unit'),
                    ])
                    ->default('company')
                    ->required()
                    ->visible(
                        fn () => auth()->user()->company_id === null
                    )
                    ->live(),

                Select::make('company_id')
                    ->label(__('Company'))
                    ->options(Company::pluck('name', 'id'))
                    ->searchable()
                    ->required()
                    ->visible(
                        fn (string $operation, $get) =>
                            $operation === 'create'
                            && auth()->user()->company_id === null
                            && $get('scope') === 'company'
                    ),

                TextInput::make('name')
                    ->label(__('Name'))
                    ->required()
                    ->maxLength(255),

                TextInput::make('symbol')
                    ->label(__('Symbol'))
                    ->required()
                    ->maxLength(10),

                Select::make('unit_type')
                    ->label(__('Unit Type'))
                    ->options(UnitType::class)
                    ->required(),

                Toggle::make('is_active')
                    ->label(__('Is Active'))
                    ->default(true),
            ]);
    }
}