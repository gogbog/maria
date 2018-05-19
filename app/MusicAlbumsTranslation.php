<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MusicAlbumsTranslation extends Model
{
    protected $table = 'music_albums_translations';

    public $timestamps = false;

    protected $fillable = [
        'title', 'description',
    ];
}
