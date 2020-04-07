<?php

namespace App\Model;


class Report extends AppModel
{
    protected $table = 'reports';
    protected $fillable = [
        'subject', 'motivation', 'body', 'email', 'answered'
    ];
}
