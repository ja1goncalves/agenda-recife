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

    public function index($data = [])
    {
        return [
            'pictures' => $this->model->listAll(isset($data['limit']) ? $data['limit'] : 10),
        ];
    }
}
