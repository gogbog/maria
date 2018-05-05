<?php

namespace App;



class PhotoAlbums extends Model
{
    protected $fillable = [
        'title', 'photo', 'background'
    ];

    public function photos() {
    	return $this->hasMany('App\Pictures', 'album_id', 'id')->get();
	}
}
