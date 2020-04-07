<?php


namespace App\Services;


use App\Model\User;
use App\Model\UserPermission;

class UsersService extends AppService
{

    /**
     * @var User
     */
    protected $model;

    /**
     * @var UserPermission
     */
    protected $permission;

    /**
     * Create a new controller instance.
     *
     * @param User $model
     * @param UserPermission $permission
     */
    public function __construct(User $model, UserPermission $permission)
    {
        $this->model = $model;
        $this->permission = $permission;
    }

    public function all(array $data)
    {
        return [
            'users' => $this->model->listAll($data),
            'filter' => [
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
            ]
        ];
    }

    public function updatePermissions(array $permissions)
    {
        unset($permissions['_token']);
        foreach ($permissions as $key => $permission):
            $user_permission = $this->permission->getById(preg_replace('/\D/', '', $key));
            $this->permission->edit($user_permission->id, ['auth' => $permission == "on"]);
        endforeach;
    }

    public function delete($id)
    {
        $this->model->remove($id);
    }
}
