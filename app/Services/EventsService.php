<?php


namespace App\Services;

use App\Model\Event;

class EventsService extends AppService
{
    /**
     * @var Event
     */
    public $model;

    /**
     * Create a new controller instance.
     *
     * @param Event $model
     */
    public function __construct(Event $model)
    {
        $this->model = $model;
    }

    public function all(array $data, array $params)
    {
        $events = $this->model->listAll($params['limit'] ?? 10, $params['order_by'] ?? 'created_at');
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
}
