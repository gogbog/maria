<?php

namespace App\Console\Commands;

use App\Events;
use App\EventsTranslation;
use Illuminate\Console\Command;

class eventsToTranslation extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'events:generate';

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
        $all_events = Events::all();

        foreach ($all_events as $event)
        {

            $eventTranslation = new EventsTranslation();
            $eventTranslation->event_id = $event->id;
            $eventTranslation->title = $event->title;
            $eventTranslation->place = $event->place;
            $eventTranslation->description = $event->description;
            $eventTranslation->price = $event->price;
            $eventTranslation->date = $event->date;
            $eventTranslation->hour = $event->hour;
            $eventTranslation->locale = 'bg';
            $eventTranslation->save();

            $this->info($event->title . ' - success');
        }
    }
}
