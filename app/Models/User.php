<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    const ROLE_USER = 'user';
    const ROLE_MANAGER = 'manager';
    const ROLE_ADMIN = 'admin';

    const ROLES = [
        self::ROLE_USER => 'model.user.role.client',
        self::ROLE_MANAGER => 'model.user.role.manager',
        self::ROLE_ADMIN => 'model.user.role.admin',
    ];

    protected $fillable = ['name', 'email', 'password', 'phone_number',];
    protected $hidden = ['password', 'remember_token',];
    protected $casts = ['email_verified_at' => 'datetime',];


}
