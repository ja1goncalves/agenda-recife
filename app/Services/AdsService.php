<?php


namespace App\Services;


use App\Model\Ad;
use Illuminate\Support\Facades\Auth;

class AdsService extends AppService
{

    /**
     * @var Ad
     */
    protected $model;

    /**
     * Create a new controller instance.
     *
     * @param Ad $model
     */
    public function __construct(Ad $model)
    {
        $this->model = $model;
    }

    public function all($data = [])
    {
        $filters = $this->filters($data);
        $ads = $this->model->findWhere($filters)
            ->limit($filters['limit'] ?? 15)
            ->orderBy('created_at', 'DESC')
            ->get();

        return [
            'ads' => $ads,
            'filter' => [
                'name' => $filters['name'] ?? '',
                'link' => $filters['link'] ?? '',
                'start_at' => $data['start_at'] ?? '',
                'end_at' => $data['end_at'] ?? '',
            ]
        ];
    }

    public function create(array $data)
    {
//        dd($data);
        $picture = isset($data['publicity']) ? $data['publicity'] : null;
        unset($data['publicity']);

        $ad = $this->model->add($data);

        if (!is_null($picture)):
            $picture = $ad->picture()->create([
                'image' => base64_encode(file_get_contents($picture->path())),
                'title' => $picture->getClientOriginalName(),
                'mimetype' => $picture->getMimeType(),
                'size' =>$picture->getSize(),
                'path' => $picture->path(),
                'imageable_type' => Ad::class,
                'imageable_id' => $ad->id,
            ]);
        endif;
    }
}
