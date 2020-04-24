<?php

namespace App\Model;


class Permission extends AppModel
{
    protected $fillable = [
        'route', 'controller', 'description', 'inactive'
    ];

    protected $table = 'permissions';

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions', 'permission_id', 'user_id');
    }

    public function userPermission()
    {
        return $this->hasMany(UserPermission::class, 'permission_id', 'id');
    }
}
