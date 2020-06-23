@extends('layout.mainlayout')

@section('template_title')
    Reviews Channel
@endsection


@section('CustomCSS')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
   <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/ui/jquery-ui.min.css')}}">
    {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
      <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">--}}
    <!-- END VENDOR CSS-->



    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap-extended.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/colors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/components.css') }}">
    <!-- END Theme CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/validation/form-validation.css')}}">
   {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/switch.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/checkboxes-radios.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/ui/jqueryui.css')}}">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/extended/form-extended.css') }}">
    <!-- END Custom CSS-->
   {{-- <style type="text/css">
        .typeahead .twitter-typeahead{
            width: 90%;
        }
    </style>--}}
    @endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h2 class="content-header-title mb-0 d-inline-block">Send Simple Message</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">

                    <div class="row justify-content-md-center" id="messagecard" >
                        <div class="col-xl-6 col-lg-7 col-md-8 col-12">
                            <div class="card" id="gift_card">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form method="post" class="form-horizontal"  id="sendmessage" novalidate>
                                            @csrf
                                            <div class="form-body skin skin-square">
                                                <div class="form-group mt-4">
                                                    <h5>Message</h5>
                                                    <fieldset class="form-group">
                                                        <textarea class="form-control" id="message" name="message" rows="5" name="description" placeholder="Message"></textarea>
                                                    </fieldset>
                                                </div>
                                            </div>
                                            <div class="form-actions center">
                                                <button type="button" class="btn btn-warning " data-href="{{route('home')}}"  >
                                                    <i class="la la-close"></i> Cancel
                                                </button>
                                                <button type="button" class="btn btn-primary"  >
                                                    <i id="submittransaction" class="la la-check-square-o"></i> Send
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@endsection


@section('CustomJS')

    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    {{--<script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>--}}
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/handlebars.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
{{--    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/formatter/formatter.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>--}}
   {{-- <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/libraries/jquery_ui/jquery-ui.min.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
   {{-- <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/blades/simplemesage.js')}}" ></script>
    <!-- END PAGE LEVEL JS-->

@endsection



