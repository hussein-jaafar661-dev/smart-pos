<?php

namespace App\Filament\Resources\Users\Pages;

use Illuminate\Database\Eloquent\Model;
use Modules\Identity\Services\UserService;
use App\Filament\Resources\Users\UserResource;
use Filament\Resources\Pages\CreateRecord;



class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;
    protected function handleRecordCreation(array $data): Model
{
    return app(UserService::class)->create($data);
}
}
