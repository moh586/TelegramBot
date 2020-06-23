<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 05/06/2020
 * Time: 10:12 AM
 */
?>

<div class="chat-message">
    <p>
        <div id="plyr-video-player">
            <iframe  src="/storage/{{\App\File::getMediaPath($message->video_id)}}" allowfullscreen allow="autoplay" ></iframe>
        </div>
        <div class="card-body p-0 mt-1 bg-transparent">
             <p class="card-text bg-transparent">{{$message->caption }}</p>
        </div>
      {{--  <figure class="card-img-top border-grey border-lighten-2 mb-0" itemprop="associatedMedia" itemscope itemtype="http://schema.org/ImageObject">

                <img class="gallery-thumbnail card-img-top" src="" itemprop="thumbnail" alt="Image description" data-action="zoom"  />

            <div class="card-body p-0 mt-1 bg-transparent">
                <p class="card-text bg-transparent">{{$message->caption }}</p>
            </div>
        </figure>--}}
    </p>
    <span class="chat-time">{{$message->created_at}}</span>
</div>