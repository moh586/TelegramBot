<!DOCTYPE html>
@php
   // include(app_path().'/Includes/jdf.php');
@endphp

@section('template_title')
    Customers
@endsection


<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        @include('layout.partials.head')
        <!-- BEGIN VENDOR CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
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
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/plugins/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css/plugins/animate/animate.css')}}">


        <!-- END Page Level CSS-->

        <!-- BEGIN Custom CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style.css') }}">
        <!-- END Custom CSS-->
    </head>
    <body class="vertical-layout vertical-menu-modern 2-columns   fixed-navbar" data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
        @include('layout.partials.navbarheader')
        @include('layout.partials.sidebar')
        <!-- BEGIN: Content-->
        <div class="app-content content">
            <div class="content-wrapper">
                <div class="content-header row">
                    <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                        <h2 class="content-header-title mb-0 d-inline-block">Customers</h2>

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
                                                <button class="btn btn-primary btn-sm" data-href="Add Customer"><i class="ft-plus white"></i> {{__('message.add_customer')}}</button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <!-- Task List table -->
                                            <div class="table-responsive">
                                                <table id="users-contacts"  class="table table-striped table-bordered base-style dataTable">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th></th>
                                                        <th>Name</th>
                                                        <th>User Name</th>
                                                        <th>Chat Count</th>
                                                        <th>Register Date</th>
                                                        <th></th>
                                                    </tr>
                                                    <tr class="text-center filter" >
                                                        <th colspan="2" ><input type="text" id="fname" class="form-control" placeholder="Name"> </th>
                                                        <th ><input type="text" id="fname" class="form-control" placeholder="User Name"></th>
                                                        <th></th>
                                                        <th></th>
                                                        <th >
                                                            <button class="btn btn-primary btn-filter"  ><i class="ft-filter"></i></button>
                                                        </th>

                                                    </tr>
                                                    </thead>
                                                    <tbody class="customerslist">
                                                    @forelse($customers as $customer)

                                                        <tr @if($customer->activated==0) class="bg-warning white" @endif  >
                                                            <td><span class="avatar avatar-online"><img src="/storage/{{$customer->avatar}}" alt="avatar"><i></i></span></td>
                                                            <td  class="text-center">
                                                                {{$customer->first_name}} {{$customer->last_name}}
                                                            </td>
                                                            <td  class="text-center">
                                                                {{$customer->username}}
                                                            </td>
                                                            <td  class="text-center">
                                                                {{$customer->chatCount()}}
                                                            </td>
                                                            <td  class="text-center">
                                                                {{\Carbon\Carbon::parse($customer->created_at)->format('d/m/Y')}}
                                                            </td>

                                                            <td class="text-center" >

                 <span class="dropdown">
                    <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                    <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5  open-left">
                        <a href="" class="dropdown-item">  Edit <i class="la la-edit"></i> </a>
                        <a href="" data-val="{{$customer->id}}" class="dropdown-item detaill"> @if(!$customer->activated)Active @else Suspend @endif <i class="la la-exclamation-circle"></i> </a>
                   </span>
                </span>
                                                            </td>
                                                        </tr>

                                                    @empty
                                                        <tr><td colspan="6" >{{__('message.nocustomer')}}</td> </tr>
                                                    @endforelse



                                                    </tbody>
                                                    <tfoot>
                                                    {{--<tr class=" text-center"><td colspan="9" class="text-center"> {{ $customers->links() }}</td> </tr>--}}
                                                    </tfoot>
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
        <section id="customersinfos">
          {{--  @include('layout.admin.customers.customerinfo')--}}
        </section>


        <!-- BEGIN VENDOR JS-->
        <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
        <!-- BEGIN VENDOR JS-->

        <!-- BEGIN PAGE VENDOR JS-->
        <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>
        <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>


        <!-- END PAGE VENDOR JS-->

        <!-- BEGIN MODERN JS-->
        <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
        <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
        <!-- END MODERN JS-->

        <!-- BEGIN PAGE LEVEL JS-->
        <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
        <script id="modalsc" src="{{ URL::asset('app-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
        <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/customer_list.js') }}" type="text/javascript"></script>
        <!-- END PAGE LEVEL JS-->

    </body>
</html>













