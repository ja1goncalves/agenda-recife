<?php


namespace App\Services;

use App\Model\Category;
use App\Model\Event;
use App\Model\EventCategory;
use App\Model\EventTag;
use App\Model\Picture;
use App\Model\Tag;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class EventsService extends AppService
{
    /**
     * @var Event
     */
    protected $model;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Tag
     */
    protected $tag;

    /**
     * @var EventCategory
     */
    protected $eventCategory;

    /**
     * @var EventTag
     */
    protected $eventTag;

    /**
     * Create a new controller instance.
     *
     * @param Event $model
     * @param Category $category
     * @param EventCategory $eventCategory
     * @param Tag $tag
     * @param EventTag $eventTag
     */
    public function __construct(Event $model, Category $category, EventCategory $eventCategory, Tag $tag, EventTag $eventTag)
    {
        $this->model = $model;
        $this->category = $category;
        $this->tag = $tag;
        $this->eventCategory = $eventCategory;
        $this->eventTag = $eventTag;
    }

    public function index(array $data)
    {
        $filters = $this->filters($data);
        $events = $this->model->findWhere($filters)
            ->orderBy('created_at', 'DESC')
            ->paginate($filters['limit'] ?? 10);

        return [
            'events' => $events,
            'categories' => $this->category->newQuery()->orderBy('name', 'desc')->get(),
            'tags' => $this->tag->newQuery()->orderBy('name', 'desc')->get(),
            'filter' => [
                'name' => $data['name'] ?? '',
                'artist' => $data['artist'] ?? '',
                'location' => $data['location'] ?? '',
                'when' => $data['when'] ?? '',
            ]
        ];
    }

    public function create(array $data)
    {
        try {
            $data['when'] = Carbon::createFromFormat('d/m/Y H:i', $data['when'].' '.$data['hour'])->format('Y-m-d H:i:s');

            if (!is_null($data['end_at'])):
                $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d H:m:s');
            endif;

            $data['indicated'] = isset($data['indicated']);
            $data['featured'] = isset($data['featured']);

            $event = $this->model->add($data);

            if (isset($data['category'])):
                foreach ($data['category'] as $id => $on):
                    $this->eventCategory->add(['event_id' => $event->id, 'category_id' => $id]);
                endforeach;
            endif;

            if (isset($data['tag'])):
                foreach ($data['tag'] as $id => $on):
                    $this->eventTag->add(['event_id' => $event->id, 'tag_id' => $id]);
                endforeach;
            endif;

            if (isset($data['main_picture'])):
                $picture = Picture::saveByImageable($data['main_picture']);
                $event = $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
            endif;

            if (isset($data['pictures'])):
                foreach ($data['pictures'] as $picture):
                    Picture::saveByImageable($picture, Event::class, $event->id);
                endforeach;
            endif;

            return $this->returnSuccess($event->toArray(), 'The event was saved!');
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }

    public function update(array $data, $id)
    {
        try {
            $event = $this->model->getById((int)$id);

            $data['when'] = Carbon::createFromFormat('d/m/Y H:i', $data['when'].' '.$data['hour'])->format('Y-m-d H:i:s');
            $data['indicated'] = isset($data['indicated']);
            $data['featured'] = isset($data['featured']);

            if (!is_null($data['end_at'])):
                $data['end_at'] = Carbon::createFromFormat('d/m/Y', $data['end_at'])->format('Y-m-d H:m:s');
            endif;
            $event = $this->model->edit($event->id, $data);

            $event->eventCategory()->delete();
            if (isset($data['category'])):
                foreach ($data['category'] as $id => $on):
                    $this->eventCategory->add(['event_id' => $event->id, 'category_id' => $id]);
                endforeach;
            endif;

            $event->eventTag()->delete();
            if (isset($data['tag'])):
                foreach ($data['tag'] as $id => $on):
                    $this->eventTag->add(['event_id' => $event->id, 'tag_id' => $id]);
                endforeach;
            endif;

            if (isset($data['main_picture'])):
                $event->mainPicture()->delete();
                $picture = Picture::saveByImageable($data['main_picture']);
                $event = $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
            endif;

            if (isset($data['pictures'])):
                $event->pictures()->delete();
                foreach ($data['pictures'] as $picture):
                    Picture::saveByImageable($picture, Event::class, $event->id);
                endforeach;
            endif;

            return $this->returnSuccess($event->toArray(), 'The event was saved');
        } catch (\Exception $e) {
            return $this->returnError($data, $e->getMessage());
        }
    }

    public function find($id)
    {
        $event = $this->model->newQuery()->where('id', '=', $id)
            ->with('pictures')->with('eventCategory')->with('eventTag')
            ->with('mainPicture')->first();
//        dd($event);
        return [
            'event' => $event,
            'categories' => $this->category->newQuery()->orderBy('name', 'desc')->get(),
            'tags' => $this->tag->newQuery()->orderBy('name', 'desc')->get(),
        ];
    }

    public function categories()
    {
        return $this->category->newQuery()->orderBy('name', 'desc')->get();
    }

    public function tags()
    {
        return $this->tag->newQuery()->orderBy('name', 'desc')->get();
    }
}
