<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class Role extends Model
{
    use HasFactory ,HasRoles;
    protected $guarded = [];

    function admins()
    {
        return $this->hasMany(Admin::class);
    }
    function permissions()
    {
        return $this->belongsToMany(Permission::class, 'role_permission');
    }
}
