<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 03/06/2020
 * Time: 02:01 AM
 */

?>
@forelse($chats as $chat)
    <li data-value="{{$chat->id}}">
        <div class="d-flex align-items-center">
            <ul class="list-unstyled users-list m-0">
                <li data-toggle="tooltip"  data-popup="tooltip-custom" data-original-title="{{$chat->getOperator()->getFullName()}}" class="avatar  pull-up p-0">
                    <img class="media-object rounded-circle" src="/storage/{{$chat->getOperator()->avatar}}" alt="Avatar">
                </li>
                <li data-toggle="tooltip" data-popup="tooltip-custom" data-original-title="{{$chat->getUser()->getFullName()}}" class="avatar  pull-up p-0">
                    <img class="media-object rounded-circle" src="/storage/{{$chat->getUser()->avatar}}" alt="Avatar">
                </li>
            </ul>
            <div class="chat-sidebar-name ml-1">
                <h6 class="mb-0">{{$chat->getOperator()->getFullName()}}</h6><span class="text-muted">{{$chat->getUser()->getFullName()}}</span>
            </div>
        </div>
    </li>
@empty
    <li class="center">
        There is no Chat
    </li>

@endforelse
