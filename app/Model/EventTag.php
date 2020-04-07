<?php

namespace App\Model;


class EventTag extends AppModel
{
    protected $table = 'events_tags';
    protected $fillable = [
        'tag_id', 'event_id'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id', 'id');
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class, 'tag_id', 'id');
    }
}
