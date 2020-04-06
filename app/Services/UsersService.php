<?php


namespace App\Services;


use App\Model\User;

class UsersService extends AppService
{

    /**
     * @var User
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
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
}
