<?php

namespace App\Model;


class Ad extends AppModel
{
    protected $table = 'ads';

    protected $fillable = [
        'name', 'start_at', 'end_at', 'link', 'visualization'
    ];

    protected $dates = [
        'start_at', 'end_at'
    ];

    public function picture()
    {
        return $this->morphOne(Picture::class, 'imageable');
    }
}
