<?php

namespace App\Model;


class UserPermission extends AppModel
{
    protected $table = 'users_permissions';
    protected $fillable = [
        'user_id', 'permission_id', 'auth'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class, 'permission_id', 'id');
    }
}
