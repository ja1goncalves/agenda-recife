<?php

namespace App\Model;

class Event extends AppModel
{
    protected $table = 'events';
    protected $fillable = [
        'name', 'description', 'location', 'when', 'sale_link', 'indicated', 'featured', 'artist'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'events_categories', 'event_id', 'category_id');
    }

    public function eventCategory()
    {
        return $this->hasMany(EventCategory::class, 'event_id', 'id');
    }

    public function eventTag()
    {
        return $this->hasMany(EventTag::class, 'event_id', 'id');
    }

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'imageable');
    }

    public function mainPicture()
    {
        return $this->belongsTo(Picture::class, 'main_picture_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'events_tags', 'event_id', 'tag_id');
    }
}
