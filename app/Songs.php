<?php


namespace App;


use Dimsav\Translatable\Translatable;

class Songs extends Model
{

    use Translatable;

    public $translationForeignKey = 'song_id';

    public $translatedAttributes = [
        'title', 'lyrics'
    ];

    public $module = 'songs';

    protected $with = ['translations'];

    protected $fillable = [
        'mp3', 'youtube_url', 'album_id',
    ];

    public function album()
    {
        return $this->hasMany('App\MusicAlbums', 'id', 'album_id')->first();
    }

    public function scopeWithSongs($query)
    {
        return $query->where('songs.mp3', '!=', 0);
    }
}
