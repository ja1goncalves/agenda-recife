<?php


namespace App\Services;


use App\Model\Permission;
use App\Model\UserPermission;

class PermissionsService extends AppService
{

    /**
     * @var Permission
     */
    protected $model;

    /**
     * @var UserPermission
     */
    protected $permission;

    /**
     * Create a new controller instance.
     *
     * @param Permission $model
     * @param UserPermission $permission
     */
    public function __construct(Permission $model, UserPermission $permission)
    {
        $this->model = $model;
        $this->permission = $permission;
    }

    public function all(array $data)
    {
        $permission = $this->model->newQuery()
            ->orderBy(isset($data['order_by']) ? $data['order_by'] : 'id', 'DESC')
            ->limit(isset($data['limit']) ? $data['limit'] : 15);

        if(isset($data['route']))
            $permission->where('route', 'like', "%{$data['route']}%");

        return [
            'permissions' => $permission->get(),
            'filter' => [
                'route' => $data['route'] ?? '',
            ]
        ];
    }

    public function inactiveRoute($id)
    {
        $permission = $this->model->getById($id);
        $this->model->edit($id, ['inactive' => !$permission->inactive]);
    }
}
