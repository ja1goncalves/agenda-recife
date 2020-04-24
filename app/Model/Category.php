<?php

namespace App\Model;


class Category extends AppModel
{
    protected $table = 'categories';

    protected $fillable = [
        'name', 'created_by', 'updated_by'
    ];

    public function events()
    {
        return $this->$this->belongsToMany(Event::class, 'events_categories', 'category_id', 'event_id');
    }

    public function eventCategory()
    {
        return $this->hasMany(EventCategory::class, 'category_id', 'id');
    }
}
