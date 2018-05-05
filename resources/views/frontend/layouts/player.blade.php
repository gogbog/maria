
    <!-- =============== START PLAYER ================ -->
    <div class="main-music-player @if (!empty($hide_player)) hide-player @endif"> <!-- hide-player -->
        <a class="hide-player-button">
            <i class="fa fa-plus"></i>
            <i class="fa fa-minus"></i>
        </a>
        <div id="mesh-main-player" class="jp-jplayer" data-audio-src="{{ Config::get('view.frontend.audio') }}/sam_rave.mp3" data-title="Rave" data-artist="Sam Paganini"></div>
        
        <div id="mesh-main-player-content" class="mesh-main-player" role="application" aria-label="media player">
            <div class="container">
                <div class="row">
                    <div class="left-player-side">
                        <div class="mesh-prev">
                            <i class="fa fa-step-backward"></i>
                        </div>
                        <div class="mesh-play">
                            <i class="fa fa-play"></i>
                        </div>
                        <div class="mesh-pause">
                            <i class="fa fa-pause"></i>
                        </div>
                        <div class="mesh-next">
                            <i class="fa fa-step-forward"></i>
                        </div>
                        <button id="playlist-toggle" class="jplayerButton">
                            <span class="span-1"></span>
                            <span class="span-2"></span>
                            <span class="span-3"></span>
                        </button>
                    </div>
                    <div class="center-side">
                        <div class="mesh-current-time">
                        </div>
                        <div class="mesh-seek-bar">
                            <div class="mesh-play-bar">
                            </div>
                        </div>
                        <div class="mesh-duration">
                        </div>
                    </div>
                    <div class="right-player-side">
                        <div class="mesh-thumbnail">
                            <img src="{{ Config::get('view.frontend.img') }}/player/thumbnail.jpg" alt="">
                        </div>
                        <div class="mesh-title">
                        </div>
                        <div class="mesh-artist">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- =============== END PLAYER ================ -->

    <!-- =============== START PLAYLIST ================ -->
    <div class="playlist-wrapper" id="playlist-wrapper">
        <div class="jp-playlist container">
            <div class="about-list clearfix">
                <span class="about-name">NAME</span>
                <span class="about-length">LENGTH</span>
            </div>

            @if (!empty(Session::get('playlist_new')) && count(Session::get('playlist_new')) > 0)
                @foreach(Session::get('playlist_new') as $song)
                    <div class="trak-item" data-audio="{{ str_replace(':pid', $song->id, Config::get('files.song') )}}/{{ $song->mp3 }}" data-artist="{{ $song->album()->title }}" data-thumbnail="{{ Config::get('view.frontend.img') }}/player/thumbnail.png" data-id="trak-200">
                        <audio preload="metadata" src="{{ str_replace(':pid', $song->id, Config::get('files.song') )}}/{{ $song->mp3 }}" title="{{ $song->title }}"></audio>
                      
                        <div class="play-pause-button">
                            <div class="center-y-table">
                                <i class="fa fa-play"></i>
                            </div>
                        </div>
                        <div class="name-artist">
                            <div class="center-y-table">
                                <h2>
                                    {{ $song->title }}
                                </h2>
                            </div>
                        </div>
                        <time class="trak-duration">
                            00:00
                        </time>
                    </div>
                @endforeach
          @endif
        </div>
    </div>
    <!-- =============== END PLAYLIST ================ -->
    
   