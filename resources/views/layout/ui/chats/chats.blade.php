<!DOCTYPE html>
@section('template_title')
    Chats
@endsection
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        @include('layout.partials.head')


        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/zoom.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/ui/plyr.min.css')}}">
        <!-- END: Vendor CSS-->

        <!-- BEGIN: Theme CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap-extended.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/colors.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/components.css')}}">
        <!-- END: Theme CSS-->

        <!-- BEGIN: Page CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/colors/palette-gradient.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/app-chats.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/plugins/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/pages/gallery.css')}}">

        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css')}}">
        <!-- END: Custom CSS-->

    </head>
    <body class="vertical-layout vertical-menu-modern content-left-sidebar chat-application  fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar">
    @include('layout.partials.navbarheader')

    @include('layout.partials.sidebar')


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="sidebar-left">
            <div class="sidebar">
                <!-- app chat user profile left sidebar start -->
                <div class="chat-user-profile">
                    <header class="chat-user-profile-header text-center border-bottom">
                        <span class="chat-profile-close">
                            <i class="ft-x"></i>
                        </span>
                        <div class="my-2">

                            <img src="../../../app-assets/images/portrait/small/avatar-s-11.png" class="round mb-1" alt="user_avatar" height="100" width="100">

                            <h5 class="mb-0">John Doe</h5>
                            <span>Designer</span>
                        </div>
                    </header>
                    <div class="chat-user-profile-content">
                        <div class="chat-user-profile-scroll">
                            <h6 class="text-uppercase mb-1">ABOUT</h6>
                            <p class="mb-2">It is a long established fact that a reader will be distracted by the readable content .</p>
                            <h6>PERSONAL INFORAMTION</h6>
                            <ul class="list-unstyled mb-2">
                                <li class="mb-25">email@gmail.com</li>
                                <li>+1(789) 950 -7654</li>
                            </ul>
                            <h6 class="text-uppercase mb-1">CHANNELS</h6>
                            <ul class="list-unstyled mb-2">
                                <li><a href="javascript:void(0);"># Devlopers</a></li>
                                <li><a href="javascript:void(0);"># Designers</a></li>
                            </ul>
                            <h6 class="text-uppercase mb-1">SETTINGS</h6>
                            <ul class="list-unstyled">
                                <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-tag mr-50"></i>
                                        Add
                                        Tag</a></li>
                                <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-star mr-50"></i>
                                        Important Contact</a>
                                </li>
                                <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-image mr-50"></i>
                                        Shared
                                        Documents</a></li>
                                <li class="mb-50 "><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-trash-2 mr-50"></i>
                                        Deleted
                                        Documents</a></li>
                                <li><a href="javascript:void(0);" class="d-flex align-items-center"><i class="ft-x-circle mr-50"></i> Blocked
                                        Contact</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- app chat user profile left sidebar ends -->
                <!-- app chat sidebar start -->
                <div class="chat-sidebar card">
                    <span class="chat-sidebar-close">
                        <i class="ft-x"></i>
                    </span>
                    <div class="chat-sidebar-search">
                        <div class="d-flex align-items-center">
                            {{--<div class="chat-sidebar-profile-toggle">
                                <div class="avatar">
                                    <img src="../../../app-assets/images/portrait/small/avatar-s-11.png" class="cursor-pointer" alt="user_avatar" height="36" width="36">
                                </div>
                            </div>--}}
                            <fieldset class="form-group position-relative has-icon-left  mb-0 col-12">
                                <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                <div class="form-control-position">
                                    <i class="ft-search text-dark"></i>
                                </div>
                            </fieldset>
                        </div>
                    </div>
                    <div class="chat-sidebar-list-wrapper pt-2">
                        <h6 class="px-2 pt-2 pb-25 mb-0">CHATS</h6>
                        <ul class="chat-sidebar-list">
                            @include('layout.ui.chats.chatlist')
                        </ul>
                    </div>
                </div>
                <!-- app chat sidebar ends -->

            </div>
        </div>
        <div class="content-right">
            <div class="content-overlay"></div>
            <div class="content-wrapper">
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <!-- app chat overlay -->
                    <div class="chat-overlay"></div>
                    <!-- app chat window start -->
                    <section class="chat-window-wrapper">
                        <div class="chat-start">
                            <span class="ft-message-square chat-sidebar-toggle chat-start-icon font-large-3 p-3 mb-1"></span>
                            <h4 class="d-none d-lg-block py-50 text-bold-500">Select a contact to start a chat!</h4>
                            <button class="btn btn-light-primary chat-start-text chat-sidebar-toggle d-block d-lg-none py-50 px-1">Start
                                Conversation!</button>
                        </div>
                        <div class="chat-area d-none">
                        @include('layout.ui.chats.chatmessages')
                        </div>
                    </section>

                    <!-- app chat window ends -->
                    <!-- app chat profile right sidebar start -->
                    <section class="chat-profile">
                        <header class="chat-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="ft-x"></i>
                            </span>
                            <div class="my-2">

                                <img src="../../../app-assets/images/portrait/small/avatar-s-26.png" class="round mb-1" alt="chat avatar" height="100" width="100">

                                <h5 class="app-chat-user-name mb-0">Elizabeth Elliott</h5>
                                <span>Devloper</span>
                            </div>
                        </header>
                        <div class="chat-profile-content p-2">
                            <h6 class="mt-1">ABOUT</h6>
                            <p>It is a long established fact that a reader will be distracted by the readable content.</p>
                            <h6 class="mt-2">PERSONAL INFORMATION</h6>
                            <ul class="list-unstyled">
                                <li class="mb-25">email@gmail.com</li>
                                <li>+1(789) 950-7654</li>
                            </ul>
                        </div>
                    </section>
                    <!-- app chat profile right sidebar ends -->

                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- BEGIN: Vendor JS-->
    <script src="{{ URL::asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/zoom.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/ui/plyr.min.js') }}" type="text/javascript"></script>

    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/pages/app-chat.js')}}"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/pages/ex-component-media-player.js') }}" type="text/javascript"></script>

    <!-- END: Page JS-->

</body>
</html>
