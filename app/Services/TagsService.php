<?php


namespace App\Services;


use App\Model\Tag;
use Illuminate\Support\Facades\Auth;

class TagsService extends AppService
{

    /**
     * @var Tag
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param Tag $model
     */
    public function __construct(Tag $model)
    {
        $this->model = $model;
    }

    public function all($data = [])
    {
        return [
            'tags' => $this->model->listAll(isset($data['limit']) ? $data['limit'] : 15),
        ];
    }

    public function create(string $name)
    {
        $user_create = Auth::user();
        $this->model->add(['name' => $name, 'created_by' => $user_create->id, 'updated_by' => $user_create->id]);
    }

    public function delete($id)
    {
        $this->model->remove($id);
    }
}
