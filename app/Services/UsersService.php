<?php


namespace App\Services;


use App\Model\Permission;
use App\Model\User;
use App\Model\UserPermission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

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


    public function index(array $data)
    {
        return [
            'users' => $this->model->listAll($data, isset($data['limit']) ? $data['limit'] : 10),
            'filter' => [
                'name' => $data['name'] ?? '',
                'email' => $data['email'] ?? '',
            ]
        ];
    }

    public function createPermissions(array $permissions, $user_id)
    {
        $permissions_able = array_keys($permissions);
        foreach (Permission::all() as $permission):
            $user_permissions = [
                'user_id' => $user_id,
                'permission_id' => $permission->id,
                'auth' => false
            ];
            if(in_array($permission->id, $permissions_able)):
                $user_permissions['auth'] = true;
                $this->permission->add($user_permissions);
            else:
                $this->permission->add($user_permissions);
            endif;
        endforeach;
    }

    public function updatePermissions(array $data)
    {
        try {
            UserPermission::where('user_id', '=', $data['user_id'])->update(['auth' => false]);
            foreach ($data['permissions'] as $id => $om):
                $user_permission = $this->permission->getById(preg_replace('/\D/', '', $id));
                $this->permission->edit($user_permission->id, ['auth' => $om == "on"]);
            endforeach;

            return $this->returnSuccess([], 'All permissions was updated');
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param null $id
     * @return array
     */
    public function update(array $data, $id = null)
    {
        try{
            $user_logged = Auth::user();

            if ($user_logged->email == $data['email']):
                $user = $this->model->getById($user_logged->id);
                $user->name = $data['name'];
                $user->email = $data['email'];
                $user->password = Hash::make($data['password']);
                $user->save();
                return $this->returnSuccess($user);
            else:
                return $this->returnError();
            endif;
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }
}
