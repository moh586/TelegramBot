<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 03/06/2020
 * Time: 02:00 AM
 */
?>
<div class="chat-header">
    <header class="d-flex justify-content-between align-items-center px-1 py-75">
        <div class="d-flex align-items-center">
            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="ft-align-justify font-large-1 cursor-pointer"></i>
            </div>
            <div class="avatar chat-profile-toggle m-0 mr-1">
                <img src="/storage/{{$chat->getOperator()->avatar}}" class="cursor-pointer" alt="avatar" height="36" width="36" />
                <span class="avatar-status-busy"></span>
            </div>
            <h6 class="mb-0">{{$chat->getOperator()->getFullName()}}</h6>
        </div>
        <div class="d-flex align-items-center">

            <h6 class="mb-0 mr-1">{{$chat->getUser()->getFullName()}}</h6>
            <div class="chat-sidebar-toggle d-block d-lg-none mr-1"><i class="ft-align-justify font-large-1 cursor-pointer"></i>
            </div>
            <div class="avatar chat-profile-toggle m-0 mr-1">
                <img src="/storage/{{$chat->getUser()->avatar}}" class="cursor-pointer" alt="avatar" height="36" width="36" />
                <span class="avatar-status-busy"></span>
            </div>
        </div>

        {{--<div class="chat-header-icons">
                                        <span class="chat-icon-favorite">
                                            <i class="ft-star font-medium-5 cursor-pointer"></i>
                                        </span>
            <span class="dropdown">
                                            <i class="ft-more-vertical font-medium-4 ml-25 cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu">
                                            </i>
                                            <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-tag mr-25"></i> Pin to top</a>
                                                <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-trash-2 mr-25"></i> Delete chat</a>
                                                <a class="dropdown-item" href="JavaScript:void(0);"><i class="ft-x-circle mr-25"></i> Block</a>
                                            </span>
                                        </span>
        </div>--}}
    </header>
</div>


<!-- chat card start -->
<div class="card chat-wrapper shadow-none mb-0">
    <div class="card-content">
        <div class="card-body chat-container">
            <div class="chat-content">
                @php
                    $i=0;
                @endphp
                @for($i=0;$i<count($messages);$i++)

                    @if($messages[$i]->getFrom()->isCustomer())
                        <div class="chat">
                            <div class="chat-avatar">
                                <a class="avatar m-0">
                                    <img src="/storage/{{$messages[$i]->getFrom()->avatar}}" alt="avatar" height="36" width="36" />
                                </a>
                            </div>
                            <div class="chat-body">
                                {{$messages[$i]->renderMessage()}}

                                @while(($i<count($messages)-1)&&$messages[$i]->getFrom()->id==$messages[$i+1]->getFrom()->id)
                                    @php
                                        $i++;
                                    @endphp
                                    {{$messages[$i]->renderMessage()}}

                                @endwhile
                            </div>
                        </div>
                    @else
                        <div class="chat chat-left">
                            <div class="chat-avatar">
                                <a class="avatar m-0">
                                    <img src="/storage/{{$messages[$i]->getFrom()->avatar}}" alt="avatar" height="36" width="36" />
                                </a>
                            </div>
                            <div class="chat-body">
                                {{$messages[$i]->renderMessage()}}

                                @while(($i<$messages->count()-1)&&$messages[$i]->getFrom()->id==$messages[$i+1]->getFrom()->id)
                                    @php
                                        $i++;
                                    @endphp
                                    {{$messages[$i]->renderMessage()}}
                                @endwhile
                            </div>
                        </div>
                    @endif
                @endfor
            </div>
        </div>
    </div>
    <div class="card-footer chat-footer px-2 py-1 pb-0">
        <form class="d-flex align-items-center" onsubmit="chatMessagesSend();" action="javascript:void(0);">
            <i class="ft-user cursor-pointer"></i>
            <i class="ft-paperclip ml-1 cursor-pointer"></i>
            <input type="text" class="form-control chat-message-send mx-1" placeholder="Type your message here...">
            <button type="submit" class="btn btn-primary glow send d-lg-flex"><i class="ft-play"></i>
                <span class="d-none d-lg-block mx-50">Send</span></button>
        </form>
    </div>
</div>
<!-- chat card ends -->
