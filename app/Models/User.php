<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory;
    use Notifiable;
    protected $fillable = [
        'type',
        'name',
        'email',
        'email_verified_at',
        'password',
        'password_changed_at',
        'active',
        'timezone',
        'last_login_at',
        'last_login_ip',
        'to_be_logged_out',
        'provider',
        'provider_id',
        'created_at',
        'updated_at',
        'deleted_at',
        'role'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password_changed_at' => 'datetime',
        'last_login_at' => 'datetime',
        'to_be_logged_out' => 'boolean',
        'active' => 'boolean'
    ];
    // User.php
public function isAdmin()
{
    return $this->role === 'admin';
}
public function payments()
{
    return $this->hasMany(Payment::class);
}

}
