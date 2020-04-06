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

    public function all(array $data)
    {
        $filters = $this->filters($data);
        $events = $this->model->findWhere($filters)
            ->limit($params['limit'] ?? 15)
            ->orderBy('created_at', 'DESC')
            ->get();

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
        $data['when'] = Carbon::createFromFormat('d/m/Y H:i', $data['when'].' '.$data['hour'])->format('Y-m-d H:i:s');

        if (!is_null($data['end_at'])):
            $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d H:m:s');
        endif;

        $data['indicated'] = isset($data['indicated']);
        $data['featured'] = isset($data['featured']);

        $event = $this->model->add($data);
        dd($event);
        if (isset($data['main_picture'])):
            $picture = $this->model->pictures()->create([
                'image' => base64_encode(file_get_contents($data['main_picture']->path())),
                'imageable_id' =>  $event->id,
                'imageable_type' => Event::class
            ]);
            $event = $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
        endif;

        if (isset($data['pictures'])):
            foreach ($data['pictures'] as $picture):
                $this->model->pictures()->create([
                    'image' => $picture,
                    'imageable_id' =>  $event->id,
                    'imageable_type' => Event::class
                ]);
            endforeach;
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
