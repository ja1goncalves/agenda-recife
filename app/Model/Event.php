<?php

namespace App\Model;

class Event extends AppModel
{
    protected $fillable = [
        'name', 'description', 'location', 'when', 'sale_link', 'indicated', 'featured'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'events_categories', 'event_id', 'category_id');
    }

    public function pictures()
    {
        return $this->morphMany(Picture::class, 'imageable');
    }

    public function mainPicture()
    {
        return $this->belongsTo(Picture::class, 'main_picture_id');
    }
}
