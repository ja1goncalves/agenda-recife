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

    public function all(array $data)
    {
        $filters = $this->filters($data);
        $events = $this->model->findWhere($filters)
            ->limit($filters['limit'] ?? 15)
            ->orderBy('created_at', 'DESC')
            ->get();

        return [
            'events' => $events,
            'categories' => $this->category->newQuery()->orderBy('name', 'desc')->get(),
            'tags' => $this->tag->newQuery()->orderBy('name', 'desc')->get(),
            'filter' => [
                'name' => $filters['name'] ?? '',
                'artist' => $filters['artist'] ?? '',
                'location' => $filters['location'] ?? '',
                'when' => $data['when'] ?? '',
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
            $picture = $event->mainPicture()->create([
                'image' => base64_encode(file_get_contents($data['main_picture']->path())),
                'title' => $data['main_picture']->getClientOriginalName(),
                'mimetype' => $data['main_picture']->getMimeType(),
                'size' => $data['main_picture']->getSize(),
                'path' => $data['main_picture']->path(),
                'imageable_type' => Event::class,
                'imageable_id' => $event->id,
            ]);
            $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
        endif;

        if (isset($data['pictures'])):
            foreach ($data['pictures'] as $picture):
                $event->pictures()->create([
                    'image' => base64_encode(file_get_contents($picture->path())),
                    'title' => $picture->getClientOriginalName(),
                    'mimetype' => $picture->getMimeType(),
                    'size' => $picture->getSize(),
                    'path' => $picture->path(),
                    'imageable_id' =>  $event->id,
                    'imageable_type' => Event::class
                ]);
            endforeach;
        endif;

        return $event;
    }

    public function update(array $data, $id)
    {
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
            $picture = Picture::saveByImageable($data['main_picture'], Event::class, $event->id);
            $this->model->edit($event->id, ['main_picture_id' => $picture->id]);
        endif;

        if (isset($data['pictures'])):
            $event->pictures()->delete();
            foreach ($data['pictures'] as $picture):
                Picture::saveByImageable($picture, Event::class, $event->id);
            endforeach;
        endif;

        return $event;
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

    public function delete($id)
    {
        $this->model->remove($id);
    }
}
