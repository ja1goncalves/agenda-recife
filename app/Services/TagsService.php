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

    public function index($data = [])
    {
        return [
            'tags' => $this->model->listAll(isset($data['limit']) ? $data['limit'] : 10),
        ];
    }

    public function create(array $data)
    {
        $user_create = Auth::user();
        try {
            $tag = $this->model->add([
                'name' => $data['name'],
                'created_by' => $user_create->id,
                'updated_by' => $user_create->id
            ]);
            return $this->returnSuccess($tag->toArray());
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }
}
