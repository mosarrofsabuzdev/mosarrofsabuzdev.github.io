<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;


    protected $fillable = [
        'name', 'email', 'password', 'role', 'avatar', 'department', 'dark_mode', 'notification_preferences',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'dark_mode' => 'boolean',
            'notification_preferences' => 'array',
        ];
    }

    public function leads(): HasMany { return $this->hasMany(Lead::class, 'assigned_to'); }
    public function managedClients(): HasMany { return $this->hasMany(Client::class, 'account_manager_id'); }
    public function tasks(): HasMany { return $this->hasMany(Task::class, 'assignee_id'); }
    public function appNotifications(): HasMany { return $this->hasMany(Notification::class); }
}
