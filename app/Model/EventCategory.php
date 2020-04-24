<?php

namespace App\Model;


class EventCategory extends AppModel
{
    protected $table = 'events_categories';
    protected $fillable = [
        'category_id', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
