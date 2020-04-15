<?php


namespace App\Services;

use App\Model\Ad;
use App\Model\Picture;
use Carbon\Carbon;

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

    public function index($data = [])
    {
        $filters = $this->filters($data);
        $ads = $this->model->findWhere($filters)
            ->with('picture')
            ->orderBy('created_at', 'DESC')
            ->paginate($filters['limit'] ?? 10);

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
        try {
            $picture = isset($data['publicity']) ? $data['publicity'] : null;
            unset($data['publicity']);

            $data['start_at'] = Carbon::createFromFormat('d/m/Y', $data['start_at'])->format('Y-m-d');
            $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d');

            $ad = $this->model->add($data);

            if (!is_null($picture))
                $picture = Picture::saveByImageable($picture, Ad::class, $ad->id);

            return $this->returnSuccess(['ads' => $ad, 'picture' => $picture ?? false]);
        } catch (\Exception $e) {
            return $this->returnError($data. $e->getMessage());
        }
    }

    /**
     * @param array $data
     * @param $id
     * @return mixed
     */
    public function update(array $data, $id)
    {
        try {
            $ad = $this->model->getById((int)$id);

            if ($ad):
                if (isset($data['publicity'])):
                    $ad->picture()->delete();
                    $picture = Picture::saveByImageable($data['publicity'], Ad::class, $ad->id);
                endif;

                $ad->name = isset($data['name']) ? $data['name'] : $ad->name;
                $ad->start_at = Carbon::createFromFormat('d/m/Y', $data['start_at'])->format('Y-m-d');
                $ad->end_at = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d');
                $ad->link = isset($data['link']) ? $data['link'] : $ad->link;

                return $this->returnSuccess(['ads' => $ad->save(), 'picture' => $picture ?? false]);
            else:
                return $this->returnError($data, "The publicity don't exist");
            endif;
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }
}
