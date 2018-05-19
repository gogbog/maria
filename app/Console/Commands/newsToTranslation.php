<?php

namespace App\Console\Commands;

use App\News;
use App\NewsTranslation;
use Illuminate\Console\Command;

class newsToTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blog:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $all_news = News::all();

        foreach ($all_news as $article)
        {

            $newsTranslation = new NewsTranslation();
            $newsTranslation->news_id = $article->id;
            $newsTranslation->title = $article->title;
            $newsTranslation->short_desc = $article->short_desc;
            $newsTranslation->description = $article->description;
            $newsTranslation->locale = 'bg';
            $newsTranslation->save();

            $this->info($article->title . ' - success');
        }
    }
}
