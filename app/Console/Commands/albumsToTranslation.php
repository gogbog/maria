<?php

namespace App\Console\Commands;

use App\MusicAlbums;
use App\MusicAlbumsTranslation;
use Illuminate\Console\Command;

class albumsToTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'albums:generate';

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
        $all_albums = MusicAlbums::all();

        foreach ($all_albums as $album)
        {

            $albumTranslation = new MusicAlbumsTranslation();
            $albumTranslation->album_id = $album->id;
            $albumTranslation->title = $album->title;
            $albumTranslation->description = $album->description;
            $albumTranslation->locale = 'bg';
            $albumTranslation->save();

            $this->info($album->title . ' - success');
        }
    }
}
