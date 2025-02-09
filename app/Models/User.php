<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['nama', 'email', 'password', 'atasan_id'];
    protected $hidden = ['password'];

    public function userRole()
    {
        return $this->hasOne(UserRole::class, 'user_id');
    }

    public function role()
    {
        return $this->hasOneThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'role_id');
    }

    public function atasan()
    {
        return $this->belongsTo(User::class, 'atasan_id');
    }

    public function bawahan()
    {
        return $this->hasMany(User::class, 'atasan_id');
    }

    public function logs()
    {
        return $this->hasMany(LogHarian::class);
    }
}