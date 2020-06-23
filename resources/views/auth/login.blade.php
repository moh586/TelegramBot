<!DOCTYPE html>
<html lang="en" data-textdirection="ltr">
<head>


    <title>Login</title>
    <link rel="apple-touch-icon" href="{{ URL::asset('app-assets/images/ico/apple-icon-120.png')}}">
    <link rel="shortcut icon" type="image/x-icon" href="{{ URL::asset('app-assets/images/ico/favicon.ico')}}">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
          rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/forms/icheck/icheck.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/forms/icheck/custom.css')}}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/bootstrap-extended.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/colors.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/components.css')}}">
    <!-- END: Theme CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/pages/login-register.css')}}">
    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
    <!-- END Custom CSS-->
</head>

<body class="vertical-layout vertical-menu-modern 1-column   menu-expanded blank-page blank-page"
      data-open="click" data-menu="vertical-menu-modern" data-col="1-column" >



<!-- ////////////////////////////////////////////////////////////////////////////-->
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section class="flexbox-container">
                <div class="col-12 d-flex align-items-center justify-content-center">
                    <div class="col-md-4 col-10 box-shadow-2 p-0">
                        <div class="card border-grey border-lighten-3 m-0">
                            <div class="card-header border-0">
                                <div class="card-title text-center">
                                    <div class="p-1">
                                        <img src="{{ URL::asset('app-assets/images/logo/logo-dark.png')}}" alt="branding logo">
                                    </div>
                                </div>
                                <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                                    <span>Login</span>
                                </h6>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form method="POST" class="form-horizontal form-simple" action="{{route('login')}}" aria-label="Login">
                                        @csrf

                                        <fieldset class="form-group position-relative has-icon-left mb-0 " >
                                            <input name="username" type="text" class="form-control form-control-lg input-lg" id="username" placeholder="Username"
                                                   required autofocus>

                                            <div class="form-control-position">
                                                <i class="ft-user"></i>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group position-relative has-icon-left ">
                                            <input type="password" class="form-control form-control-lg input-lg" id="password" name="password"
                                                   placeholder="Password" required>

                                            <div class="form-control-position">
                                                <i class="la la-key"></i>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-md-6 col-12 text-center text-md-left">
                                                <fieldset>
                                                    <input type="checkbox" id="remember" name="remember" class="chk-remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label for="remember-me"> Remember Me</label>
                                                </fieldset>
                                            </div>
                                            <div class="col-md-6 col-12 text-center text-md-right"><a href="{{ route('password.request') }}" class="card-link">Forgot Password?</a></div>
                                        </div>
                                        <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>Login</button>
                                    </form>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
<!-- ////////////////////////////////////////////////////////////////////////////-->


    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>

    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/forms/form-login-register.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->



</body>
</html>



