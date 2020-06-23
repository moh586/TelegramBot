@extends('layout.mainlayout')

@section('template_title')
    {{__('message.page.editbranch')}}
@endsection

@section('CustomCSS')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/spinner/jquery.bootstrap-touchspin.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">


    <!-- END VENDOR CSS-->

    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/switch.css')}}">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style-rtl.css') }}">
    <!-- END Custom CSS-->
@endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.page.createbranch')}}</h2>

                </div>

            </div>

            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">


                    <div class="row justify-content-md-center">
                        <div class="col-md-6">
                            <div class="card">
                                @if ($errors->any())
                                    <div class="col-xl-12 col-lg-12">

                                            @foreach ($errors->all() as $error)
                                                <div class="alert bg-danger alert-dismissible mb-2" role="alert" style="margin-top: 10px">
                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                     {{$error}}
                                                </div>
                                            @endforeach

                                    </div>
                                @endif
                                <div class="card-content collapse show">
                                    <div class="card-body">

                                        <form method="post" class="form" action="{{route('branch.update',['id'=>$branch->id])}}" id="createbranch" novalidate>
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <h5>{{__('message.name')}}
                                                        <span class="required">*</span>
                                                    </h5>
                                                    {{--<label for="eventRegInput1">{{__('message.name')}}</label>--}}
                                                    <div class="controls">
                                                        <input type="text" required  id="eventRegInput1" class="form-control" placeholder="{{__('message.name')}}" name="name"  data-validation-required-message="{{__('message.required')}}" value="{{$branch->name}}">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{{__('message.email')}}
                                                        <span class="required">*</span>
                                                    </h5>
                                                    {{--<label for="eventRegInput1">{{__('message.name')}}</label>--}}
                                                    <div class="controls">
                                                        <input type="text" required  data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="{{__('message.validemail')}}" id="eventRegInput2" class="form-control"
                                                               placeholder="{{__('message.email')}}" name="email" data-validation-required-message="{{__('message.required')}}"  value="{{$branch->email}}">

                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <h5>{{__('message.address')}}
                                                        <span class="required">*</span>
                                                    </h5>
                                                    {{--<label for="eventRegInput1">{{__('message.name')}}</label>--}}
                                                    <div class="controls">
                                                        <input type="text"  id="eventRegInput3" class="form-control"  required placeholder="{{__('message.address')}}" data-validation-required-message="{{__('message.required')}}" name="address" value="{{$branch->address}}">
                                                        <div class="help-block"></div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-actions center">
                                                <button type="button" class="btn btn-warning " data-href="{{route('branchlist')}}"  >
                                                    <i class="la la-close"></i> {{__('message.cancel')}}
                                                </button>
                                                <button type="submit" class="btn btn-primary" {{--onclick="document.getElementById('createbranch').submit()"--}} >
                                                    <i class="la la-check-square-o"></i> {{__('message.save')}}
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
    <script src="{{ URL::asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/blades/createbranch.js')}}" ></script>
    <!-- END PAGE LEVEL JS-->




@endsection
