<?php


namespace App;



class Songs extends Model
{
        protected $fillable = [
        	'title','lyrics', 'mp3', 'youtube_url', 'album_id',
    	];

    	public function album() {
        	return $this->hasMany('App\MusicAlbums', 'id', 'album_id')->first();
    	}

    	public function scopeWithSongs($query)
    	{
    		return $query->where('songs.mp3', '!=', 0);
    	}
}
