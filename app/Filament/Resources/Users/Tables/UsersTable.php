<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Actions\DeleteAction;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Filters\TernaryFilter;
class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
    ->label(__('Name'))
    ->searchable()
    ->sortable(),
    TextColumn::make('username')
    ->label(__('Username'))
    ->searchable()
    ->sortable(),
    TextColumn::make('email')
    ->label(__('Email'))
    ->searchable()
    ->sortable(),
   
    TextColumn::make('roles.name')
    ->label(__('Role'))
    ->badge(),
    TextColumn::make('created_at')
    ->label(__('Created At'))
    ->dateTime()
    ->sortable(),
    TextColumn::make('updated_at')
    ->label(__('Updated At'))
    ->dateTime()
    ->sortable(),
    TextColumn::make('deleted_at')
    ->label(__('Deleted At'))
    ->dateTime()
    ->sortable(),
    TextColumn::make('last_login_at')
    ->label(__('Last Login At'))
    ->dateTime()
    ->sortable(),
    IconColumn::make('is_active')
     ->label(__('Is Active'))
    ->boolean(),
   
    
    TextColumn::make('company.name')
    ->label(__('Company'))
    ->searchable()
    ->sortable(),
    TextColumn::make('branch.name')
    ->label(__('Branch'))
    ->searchable()
    ->sortable(),
    TextColumn::make('phone')
    ->label(__('Phone'))
    ->searchable()
    ->sortable()
    



            ])
            ->filters([
                SelectFilter::make('role')
        ->label(__('Role'))
        ->relationship('roles', 'name'),
        TernaryFilter::make('is_active')
        ->label(__('Status'))
        ->boolean(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ])
            ]);
        
    }
}
