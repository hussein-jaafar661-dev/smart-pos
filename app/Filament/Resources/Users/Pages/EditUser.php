<?php

namespace App\Filament\Resources\Users\Pages;

use Illuminate\Database\Eloquent\Model;
use Modules\Identity\Services\UserService;
use App\Filament\Resources\Users\UserResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getHeaderActions(): array
    {
        return [
DeleteAction::make()
    ->action(function (Model $record) {
        app(UserService::class)->delete($record);
    }),        ];
    }
    protected function handleRecordUpdate(Model $record, array $data): Model
{
    return app(UserService::class)->update($record, $data);
}
}
