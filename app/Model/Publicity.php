<?php

namespace App\Model;


class Publicity extends AppModel
{
    protected $table = 'ads';

    protected $fillable = [
        'name', 'publicity', 'start_at', 'end_at', 'link', 'visualization'
    ];

    protected $dates = [
        'start_at', 'end_at'
    ];
}
