<?php

namespace App\Model;


class Report extends AppModel
{
    protected $fillable = [
        'subject', 'motivation', 'body', 'email', 'answered'
    ];
}
