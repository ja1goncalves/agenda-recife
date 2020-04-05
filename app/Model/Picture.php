<?php

namespace App\Model;


class Picture extends AppModel
{
    protected $fillable = [
        'image', 'imageable_id', 'imagable_type'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
