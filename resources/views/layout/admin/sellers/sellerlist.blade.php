<!DOCTYPE html>

@section('template_title')
    Seller List
@endsection
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        @include('layout.partials.head')
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/tables/datatable/datatables.min.css')}}">
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
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/plugins/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/page-users.css')}}">
        <!-- END: Page CSS-->

        <!-- BEGIN: Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css')}}">
        <!-- END: Custom CSS-->

    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
    @include('layout.partials.navbarheader')
    @include('layout.partials.sidebar')
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h2 class="content-header-title mb-0 d-inline-block">Sellers</h2>
                </div>

            </div>

            <div class="content-body">
                <section class="row">
                    @if (session()->has('success'))
                        <script type="text/javascript">
                            window.onload=function(){
                                //toastr.success('hi');
                                toastr.success('{{session()->get('success')}}');
                            };
                        </script>
                    @elseif(session()->has('errors'))
                        <script type="text/javascript">
                            window.onload=function(){
                                //toastr.success('hi');
                                toastr.error('{{session()->get('errors')}}');
                            };
                        </script>
                    @endif
                    <div class="col-12">
                        <div class="card">
                            <div class="card-head">
                                <div class="card-header">
                                    <h3 class="card-title"></h3>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <button class="btn btn-primary btn-sm" data-href=""><i class="ft-plus white"></i> Add Seller</button>
                                    </div>
                                </div>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <!-- Task List table -->
                                    <div class="table-responsive">
                                        <table id="users-contacts" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                            <thead>
                                            <tr class="text-center">
                                                <th></th>
                                                <th>Name</th>
                                                <th>User Name</th>
                                                <th>Chat Count</th>
                                                <th>Register Date</th>
                                                <th>Status</th>
                                                <th></th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($users as $user)
                                                <tr @if($user->activated==0) class="alert alert-dark mb-2" @endif >
                                                    <td><span class="avatar avatar-online"><img src="/storage/{{$user->avatar}}" alt="avatar"><i></i></span></td>
                                                    <td class="text-center">
                                                        {{$user->first_name}} {{$user->last_name}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$user->username}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{$user->chatCount()}}
                                                    </td>
                                                    <td class="text-center">
                                                        {{\Carbon\Carbon::parse($user->updated_at)->format('d/m/Y')}}
                                                    </td>

                                                    <td class="text-center">
                                                        @if($user->activated==0)
                                                            <span class="badge badge-danger">DeActive</span>
                                                        @else
                                                            <span class="badge badge-success">Active</span>
                                                        @endif

                                                    </td>
                                                    <td>
                                                        <span class="dropdown">
                                                            <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                            <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5 open-left">
                                                                <a href="{{--{{route('user.edit',['id'=>$user->id])}}--}}" class="dropdown-item">  <i class="ft-edit-2"></i>Edit  </a>
                                                                <a href="#" class="dropdown-item"><i class="ft-trash-2"></i>Delete  </a>
                                                                <a href="#" data-val="{{$user->id}}" class="dropdown-item detaill"><i class="ft-disc"></i> @if($user->activated==0) Active @else DeActive @endif  </a>
                                                           </span>
                                                        </span>
                                                    </td>
                                                </tr>

                                            @empty
                                                <tr><td colspan="6" class="text-center">No Seller</td> </tr>
                                            @endforelse
                                            </tbody>

                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>


        </div>
    </div>
    <!-- END: Content-->




    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/blades/seller_list.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->


    </body>
</html>

