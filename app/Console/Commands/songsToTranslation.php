<?php

namespace App\Console\Commands;

use App\Songs;
use App\SongsTranslation;
use Illuminate\Console\Command;

class songsToTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'songs:generate';

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
        $songs = Songs::all();

        foreach ($songs as $song)
        {

            $songTranslation = new SongsTranslation();
            $songTranslation->song_id = $song->id;
            $songTranslation->title = $song->title;
            $songTranslation->lyrics = $song->lyrics;
            $songTranslation->locale = 'bg';
            $songTranslation->save();

            $this->info($song->title . ' - success');
        }
    }
}
