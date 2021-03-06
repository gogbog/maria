<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NewsTranslation extends Model
{
    protected $table = 'news_translations';

    public $timestamps = false;

    protected $fillable = [
        'title', 'description', 'short_desc'
    ];
}
