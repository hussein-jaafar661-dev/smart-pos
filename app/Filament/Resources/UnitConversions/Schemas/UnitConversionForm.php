<?php

namespace App\Filament\Resources\UnitConversions\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Modules\Inventory\Models\Unit;
use Modules\Company\Models\Company;

class UnitConversionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('company_id')
                ->label(__('Company'))
                ->options(Company::pluck('name', 'id'))
                ->searchable()
                ->required()
                ->visible(
                    fn (string $operation) =>
                        $operation === 'create'
                        && auth()->user()->company_id === null
                ),
               Select::make('from_unit_id')
                ->label(__('From Unit'))
                ->options(function ($get) {
                    $companyId = $get('company_id') ?? auth()->user()->company_id;
                    return Unit::query()
                        ->where('is_active', true)
                        ->where(function ($query) use ($companyId) {
                            $query
                                ->whereNull('company_id')
                                ->orWhere('company_id', $companyId);
                        })
                        ->pluck('name', 'id');
                })
                ->searchable()
                ->required(),
                Select::make('to_unit_id')
                ->label(__('To Unit'))
                ->options(function ($get) {
                    $companyId = $get('company_id') ?? auth()->user()->company_id;
                        return Unit::query()
                            ->where('is_active', true)
                            ->where(function ($query) use ($companyId) {
                                $query
                                    ->whereNull('company_id')
                                    ->orWhere('company_id', $companyId);
                            })
                            ->pluck('name', 'id');
                    })
                ->searchable()
                ->required(),
                TextInput::make('factor')
                ->label(__('Conversion Factor'))
                ->numeric()
                ->required()
                ->minValue(0.0000000001),
                //
            ]);
    }
}
