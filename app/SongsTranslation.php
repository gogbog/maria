<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SongsTranslation extends Model
{
    protected $table = 'songs_translations';

    public $timestamps = false;

    protected $fillable = [
        'title', 'lyrics',
    ];
}
