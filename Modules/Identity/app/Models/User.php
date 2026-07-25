<?php

namespace Modules\Identity\Models;

use Modules\Company\Models\Company;
use Modules\Company\Models\Branch;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
class User extends Authenticatable implements FilamentUser
{
    use HasFactory;
    use Notifiable;
    use HasRoles;

    protected $fillable = [
        'company_id',
        'branch_id',
        'name',
        'username',
        'email',
        'phone',
        'password',
        'is_active',
        'last_login_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_login_at' => 'datetime',
            'password' => 'hashed',
            'is_active' => 'boolean',
        ];
    }
    public function company(): BelongsTo
{
    return $this->belongsTo(Company::class);
}

public function branch(): BelongsTo
{
    return $this->belongsTo(Branch::class);
}
public function canAccessPanel(Panel $panel): bool
{
    return $this->is_active;
}
}