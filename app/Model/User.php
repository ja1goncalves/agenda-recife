<?php

namespace App\Model;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'users_permissions', 'user_id', 'permission_id');
    }

    public function listAll($limit = 10)
    {
        if(Auth::user()->id == 1):
            return User::orderBy('name')->paginate($limit);
        else:
            return User::where('id', '<>', 1)->orderBy('name')->paginate($limit);
        endif;
    }

    public function getById(int $id)
    {
        return User::find($id);
    }

    public function add(Array $data)
    {
        return User::create($data);
    }

    public function edit($id, $data)
    {
        $user = $this->getById($id);
        foreach($data as $key => $linha):
            $user->{$key} = $linha;
        endforeach;
        return $user->save();
    }

    public function remove($id)
    {
        $user = $this->getById($id);
        return $user->delete();
    }
}
