<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    public $timestamps = false;
    protected $fillable = ['role_name'];

    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'role_id');
    }
}
