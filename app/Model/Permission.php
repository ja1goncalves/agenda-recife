<?php

namespace App\Model;


class Permission extends AppModel
{
    protected $fillable = [
        'route', 'controller', 'description'
    ];

    protected $table = 'permissions';

    public function users()
    {
        return $this->belongsToMany(User::class, 'users_permissions', 'permission_id', 'user_id');
    }
}
