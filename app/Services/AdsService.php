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

    public function all($data = [])
    {
        $filters = $this->filters($data);
        $ads = $this->model->findWhere($filters)
            ->with('picture')
            ->limit($filters['limit'] ?? 15)
            ->orderBy('created_at', 'DESC')
            ->get();
//        dd($ads);
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
        $picture = isset($data['publicity']) ? $data['publicity'] : null;
        unset($data['publicity']);

        $data['start_at'] = Carbon::createFromFormat('d/m/Y', $data['start_at'])->format('Y-m-d');
        $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d');

        $ad = $this->model->add($data);

        if (!is_null($picture)):
            $picture = Picture::saveByImageable($picture, Ad::class, $ad->id);
        endif;
    }

    /**
     * @param array $data
     * @return mixed
     */
    public function update(array $data)
    {
//        dd($data);
        $ad = $this->model->getById((int)$data['id']);

        if ($ad):
            if (isset($data['publicity'])):
                $ad->picture()->delete();
                $picture = Picture::saveByImageable($data['publicity'], Ad::class, $ad->id);
            endif;

            $ad->name = isset($data['name']) ? $data['name'] : $ad->name;
            $ad->start_at = Carbon::createFromFormat('d/m/Y', $data['start_at'])->format('Y-m-d');
            $ad->end_at = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d');
            $ad->link = isset($data['link']) ? $data['link'] : $ad->link;

            return $ad->save();
        else:
            return false;
        endif;
    }

    public function delete($id)
    {
        $this->model->remove($id);
    }

}
