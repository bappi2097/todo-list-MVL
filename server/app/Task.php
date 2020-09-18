<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Collection;

class Task extends Collection
{
    protected $connection = 'mongodb';
    protected $collection = 'tasks';
    protected $fillable = [
        'title'
    ];
}
