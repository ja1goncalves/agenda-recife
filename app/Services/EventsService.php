<?php


namespace App\Services;

use App\Model\Event;
use App\Model\Picture;
use Carbon\Carbon;

class EventsService extends AppService
{
    /**
     * @var Event
     */
    protected $model;

    /**
     * @var Picture
     */
    protected $picture;

    /**
     * Create a new controller instance.
     *
     * @param Event $model
     * @param Picture $picture
     */
    public function __construct(Event $model, Picture $picture)
    {
        $this->model = $model;
        $this->picture = $picture;
    }

    public function all(array $data, array $params)
    {
        $events = $this->model->findWhere([
            'name' => $params['name'] ?? null,
            'artist' => $params['artist'] ?? null,
            'location' => $params['location'] ?? null,
            'when' => $params['when'] ?? null,
        ])->limit($params['limit'] ?? 15)->orderBy('created_at', 'DESC')->get();

        return [
            'events' => $events,
            'filter' => [
                'name' => $params['name'] ?? '',
                'artist' => $params['artist'] ?? '',
                'location' => $params['location'] ?? '',
                'when' => $params['when'] ?? '',
            ]
        ];
    }

    public function create(array $data)
    {
        dd($data);
        $data['when'] = Carbon::createFromFormat('d/m/Y', $data['when'])->format('Y-m-d H:m:s');

        if (isset($data['end_at'])):
            $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d H:m:s');
        endif;

        $event = $this->model->add($data);

        if (!is_null($data['pictures'])):
            foreach ($data['pictures'] as $picture):
                $this->model->pictures()->create([
                    'image' => $picture,
                    'imageable_id' =>  $event->id,
                    'imageable_type' => Event::class
                ]);
            endforeach;
        endif;

        if (!is_null($data['main_picture'])):
            $picture = $this->model->pictures()->create([
                'image' => $data['main_picture'],
                'imageable_id' =>  $event->id,
                'imageable_type' => Event::class
            ]);
            $event = $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
        endif;

        return [
            'events' => $this->model->listAll(),
            'filter' => [
                'name' => $params['name'] ?? '',
                'artist' => $params['artist'] ?? '',
                'location' => $params['location'] ?? '',
                'when' => $params['when'] ?? '',
            ]
        ];

    }
}
