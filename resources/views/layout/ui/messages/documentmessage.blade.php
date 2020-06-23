<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 05/06/2020
 * Time: 10:12 AM
 */
?>

<div class="chat-message">
    <p><a href="/storage/{{\App\File::getMediaPath($message->document_id)}}"  >  Document</a></p>
    <div class="card-body p-0 mt-1 bg-transparent">
        <p class="card-text bg-transparent">{{$message->caption }}</p>
    </div>
    <span class="chat-time">{{$message->created_at}}</span>
</div>