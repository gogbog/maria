<?php

namespace App;


use Dimsav\Translatable\Translatable;

class MusicAlbums extends Model
{
    use Translatable;

    public $translationForeignKey = 'album_id';

    public $translatedAttributes = [
        'title', 'description'
    ];

    public $module = 'music_albums';
    protected $with = ['translations'];

    protected $fillable = [
        'disc_image', 'album_image', 'background_image',
    ];
}
