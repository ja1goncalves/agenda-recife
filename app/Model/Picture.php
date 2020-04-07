<?php

namespace App\Model;


class Picture extends AppModel
{
    protected $table = 'pictures';
    protected $fillable = [
        'image', 'title', 'mimetype', 'size', 'path', 'imageable_id', 'imageable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
