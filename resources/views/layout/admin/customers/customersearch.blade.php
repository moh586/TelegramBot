@extends('layout.mainlayout')

@section('template_title')
    {{__('message.page.searchcustomer')}}
@endsection


@section('CustomCSS')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
 {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">--}}
    <!-- END VENDOR CSS-->



    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
   {{-- <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/checkboxes-radios.css')}}">--}}
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/extended/form-extended.css') }}">
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
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.page.searchcustomer')}}</h2>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row justify-content-md-center">
                        <div class="col-xl-5 col-md-7 col-12">
                            <div class="card ">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <fieldset class="form-group position-relative typeahead">
                                            <input type="text" class="form-control form-control-xl input-xl text-center  " placeholder="" id="searchtxt" aria-describedby="button-addon2">
                                            <div class="form-control-position mr-1 ml-1">
                                                <i id="searchicon" class="ft ft-search font-large-1"></i>
                                            </div>
                                           {{-- <div class="input-group-append ">
                                                <button class="btn btn-primary  " id="serachcustomer" type="button"><i id="searchicon" class="ft ft-search"></i></button>
                                                --}}{{--<button class="btn btn-primary round " id="serachcustomer" type="button"><i class="la la-rotate-left icon-spin"></i></button>--}}{{--
                                            </div>--}}
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="card card border-teal border-lighten-2"   id="resultcard" style="display: none">
                                <div class="text-center">
                                    <div class="card-body">
                                        <img src="" class="rounded-circle  height-150" alt="Card image" id="avatar">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title" id="name">Andrew Davis</h4>
                                        <h6 class="card-subtitle text-muted" id="level">UI/UX Designer</h6>
                                    </div>
                                    <div class="card-body">
                                        <button type="button" class="btn btn-warning mr-1" data-href="{{route('customerslist')}}"  >
                                            <i class="ft-x"></i> {{__('message.cancel')}}
                                        </button>
                                        <button type="button" class="btn btn-primary  mr-1" data-href="1"  >
                                            <i class="ft-check-square"></i> {{__('message.customer_edit')}}
                                        </button>
                                        <button type="button" class="btn btn-success">
                                            <i class="ft-trending-up"></i> {{__('message.customer.report')}}
                                        </button>
                                       {{-- <button type="button" class="btn btn-danger mr-1"><i class="la la-plus"></i> Follow</button>
                                        <button type="button" class="btn btn-primary mr-1"><i class="ft-user"></i> Profile</button>--}}
                                    </div>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="#" id="phone" class="list-group-item"><i class="la la-phone"></i> Overview</a>
                                    <a href="#" id="email" class="list-group-item"><i class="la la-paper-plane"></i> Email</a>
                                    <a href="#" id="activity" class="list-group-item"><i class="la la-venus"></i> Task</a>
                                    <a href="#" id="score" class="list-group-item"> <i class="la la-gift"></i> Calender</a>
                                </div>
                            </div>
                            {{--<div class="card "  id="resultcard" style="display: none">
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form method="get" class="form"  id="createbranch" >

                                            <input type="hidden" id="id">
                                            <div class="form-body">
                                                <h4 class="form-section"><i class="ft-user"></i> {{__('message.customer_info')}}</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="fname">{{__('message.name')}}</label>
                                                            <input readonly="readonly" type="text" id="fname" class="form-control" placeholder="{{__('message.name')}}"
                                                                   name="fname">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="lname">{{__('message.lname')}}</label>
                                                            <input readonly="readonly" type="text" id="lname" class="form-control" placeholder="{{__('message.lname')}}"
                                                                   name="lname">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="mobile">{{__('message.mobile')}}</label>
                                                            <input readonly="readonly" type="text" id="mobile" class="form-control" placeholder="{{__('message.mobile')}}" name="phone">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="email">{{__('message.email')}}</label>
                                                            <input readonly="readonly" type="text" id="email" class="form-control" placeholder="{{__('message.email')}}" name="email">
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="form-actions center">
                                                    <button type="button" class="btn btn-warning mr-1" data-href="{{route('customerslist')}}"  >
                                                        <i class="ft-x"></i> {{__('message.cancle')}}
                                                    </button>
                                                    <button type="button" class="btn btn-primary  mr-1" data-href="1"  >
                                                        <i class="ft-check-square"></i> {{__('message.customer_edit')}}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>--}}
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
{{--    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/formatter/formatter.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>--}}
   {{-- <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>--}}
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
   {{-- <script src="{{ URL::asset('app-assets/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>--}}
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/blades/customersearch.js')}}" ></script>
    <!-- END PAGE LEVEL JS-->

@endsection



