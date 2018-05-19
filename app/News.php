<?php

namespace App;



use Dimsav\Translatable\Translatable;

class News extends Model
{
    use Translatable;

    public $translationForeignKey = 'news_id';

    public $translatedAttributes = [
        'title', 'description', 'short_desc'
    ];

    public $module = 'news';
    protected $with = ['translations'];

    protected $fillable = [
        'img',
    ];

}
