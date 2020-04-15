<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'api_token', 'master'
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

    public function userPermissions()
    {
        return $this->hasMany(UserPermission::class, 'user_id', 'id');
    }

    public function listAll(array $filter, $limit = 10)
    {
        $users = User::query()->with('userPermissions.permission');
        if(isset($filter['name']))
            $users = $users->where('name', 'like', "%{$filter['name']}%");

        if(isset($filter['email']))
            $users = $users->where('name', 'like', "%{$filter['email']}%");

        if(Auth::user()->id == 1):
            return $users->orderBy('created_at', 'ASC')
                ->limit(isset($filter['limit']) ? $filter['limit'] : $limit )
                ->paginate(isset($filter['page']) ? $filter['page'] : 1);
        else:
            return $users->where('id', '<>', 1)->orderBy('id', 'DESC')->paginate($limit);
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

    public function findWhere(array $wheres, $finish = false, $columns = ['*'])
    {
        $query = self::query();
        foreach ($wheres as $key => $value):
            if (is_array($value) && count($value) >= 3):
                $query->where($value[0], $value[1], $value[2]);
            else:
                if(Schema::hasColumn($this->table, $key)):
                    if (strtotime($value) !== false):
                        $date_start = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d 00:00:00');
                        $date_end = Carbon::createFromFormat('Y-m-d', $value)->format('Y-m-d 23:59:59');
                        $query->whereBetween($key, [$date_start, $date_end]);
                    else:
                        $query->where($key, '=', $value);
                    endif;
                endif;
            endif;
        endforeach;

        return $finish ? $query->get($columns) : $query;
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
