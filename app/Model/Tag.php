<?php

namespace App\Model;
;

class Tag extends AppModel
{
    protected $fillable = [
        'name', 'searched_count', 'created_by', 'updated_by'
    ];

    public function events()
    {
        return $this->belongsToMany(Event::class, 'events_tags', 'tag_id', 'event_id');
    }
}
