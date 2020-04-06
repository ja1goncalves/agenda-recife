<?php


namespace App\Services;


use App\Model\Category;
use Illuminate\Support\Facades\Auth;

class CategoriesService extends AppService
{

    /**
     * @var Category
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param Category $model
     */
    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    public function all($data = [])
    {
        return [
            'categories' => $this->model->listAll(isset($data['limit']) ? $data['limit'] : 15),
        ];
    }

    public function create(string $name)
    {
        $user_create = Auth::user();
        $this->model->add(['name' => $name, 'created_by' => $user_create->id, 'updated_by' => $user_create->id]);
    }
}
