<?php

namespace App;


use Dimsav\Translatable\Translatable;

class Events extends Model
{
    use Translatable;

    public $translationForeignKey = 'event_id';

    public $translatedAttributes = [
        'title', 'place', 'description', 'price', 'date', 'hour'
    ];

    public $module = 'events';
    protected $with = ['translations'];


    protected $fillable = [

    ];
}
