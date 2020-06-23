@extends('layout.mainlayout')

@section('template_title')
    {{__('message.page.createuser')}}
@endsection

@section('CustomCSS')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
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

                                        <form method="post" class="form" action="{{route('user.store')}}" id="createbranch" novalidate>
                                            @csrf
                                            <div class="form-body">
                                                <div class="form-group">
                                                    <label for="eventRegInput1">{{__('message.name')}}</label>
                                                    <input type="text" required id="eventRegInput1" class="form-control" placeholder="{{__('message.name')}}" name="fname" data-validation-required-message="{{__('message.required')}}">
                                                    <div class="help-block"></div>
                                                </div>

                                                <div class="form-group">
                                                    <label for="eventRegInput2">{{__('message.lname')}}</label>
                                                    <input type="text" required id="eventRegInput2" class="form-control" placeholder="{{__('message.lname')}}" name="lname" data-validation-required-message="{{__('message.required')}}">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eventRegInput3">{{__('message.username')}}</label>
                                                    <input type="text"  id="eventRegInput3" class="form-control" placeholder="{{__('message.username')}}" name="username" >
                                                </div>
                                                <div class="form-group">
                                                    <label for="eventRegInput4">{{__('message.password')}}</label>
                                                    <input type="password" required id="eventRegInput4" class="form-control" placeholder="{{__('message.password')}}" name="password" data-validation-required-message="{{__('message.required')}}">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eventRegInput5">{{__('message.mobile')}}</label>
                                                    <input type="number" required id="eventRegInput5" class="form-control" minlength="11" maxlength="11" placeholder="{{__('message.mobile_example')}}" name="mobile"
                                                           data-validation-required-message="{{__('message.required')}}" data-validation-minlength-message="{{__( 'message.mobile_validation')}}" data-validation-maxlength-message="{{__( 'message.mobile_validation')}}">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="eventRegInput6">{{__('message.email')}}</label>
                                                    <input type="text" required  data-validation-regex-regex="([a-z0-9_\.-]+)@([\da-z\.-]+)\.([a-z\.]{2,6})" data-validation-regex-message="{{__('message.validemail')}}" id="eventRegInput6" class="form-control" placeholder="{{__('message.email')}}" name="email" data-validation-required-message="{{__('message.required')}}">
                                                    <div class="help-block"></div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="text-bold-600 font-medium-2">
                                                        {{__('message.branch')}}
                                                    </div>
                                                    <select novalidate  class="select2 form-control" multiple="multiple" id="branchs"  name="branch[]" >
                                                        @foreach($branchs as $branch)
                                                            <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="form-group">
                                                    <div class="text-bold-600 font-medium-2">
                                                        {{__('message.role')}}
                                                    </div>
                                                    <select  class="select2 form-control" multiple="multiple" id="roles" tabindex="-1" aria-hidden="true" name="roles[]" style="width: 100%">
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                    </select>

                                                </div>


                                            </div>
                                            <div class="form-actions center">
                                                <button type="button" class="btn btn-warning " data-href="{{route('userslist')}}"  >
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
    <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>
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
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script src="{{ URL::asset('app-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/blades/createbranch.js')}}" ></script>
    <!-- END PAGE LEVEL JS-->

@endsection


