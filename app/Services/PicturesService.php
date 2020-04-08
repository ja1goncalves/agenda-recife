<?php


namespace App\Services;


use App\Model\Picture;
use Illuminate\Support\Facades\Auth;

class PicturesService extends AppService
{

    /**
     * @var Picture
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param Picture $model
     */
    public function __construct(Picture $model)
    {
        $this->model = $model;
    }

    public function all($data = [])
    {
        return [
            'pictures' => $this->model->listAll(isset($data['limit']) ? $data['limit'] : 10),
        ];
    }

    public function create(string $data, string $type, $id)
    {
        return Picture::saveByImageable($data, $type, $id);
    }

    public function delete($id)
    {
        return $this->model->remove((int)$id);
    }
}
