<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventsTranslation extends Model
{
    protected $table = 'events_translations';

    public $timestamps = false;

    protected $fillable = [
        'event_id',
        'title',
        'place',
        'description',
        'price',
        'date',
        'hour'
    ];


}
