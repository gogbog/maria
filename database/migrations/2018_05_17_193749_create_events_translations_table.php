<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('event_id')->unsigned();
            $table->string('title')->nullable()->default(null);
            $table->string('place')->nullable()->default(null);
            $table->text('description')->nullable()->default(null);
            $table->string('date')->nullable()->default(null);
            $table->string('hour')->nullable()->default(null);
            $table->float('price', 10, 2)->nullable()->default('0.00');
            $table->string('locale')->index();

            $table->unique([
                'event_id',
                'locale'
            ]);

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::drop('events_translations');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
