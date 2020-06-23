
@extends('layout.mainlayout')


@section('template_title')
    {{$customlist->name}}
@endsection


@section('CustomCSS')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css-rtl/plugins/animate/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/pickers/persiandatetimepicker/persianDatepicker-default.css')}}">

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
                    <h2 class="content-header-title mb-0 d-inline-block">{{$customlist->name}}</h2>

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
                                        <h3 class="card-title">{{--{{__('message.page.allcustomer')}}--}}</h3>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <button class="btn btn-primary btn-sm" data-href="{{route('customer.create')}}"><i class="ft-plus white"></i> {{__('message.add_customer')}}</button>
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
                                                    @foreach($fields as $field)
                                                        <th  >{{__('message.customerlist.list.'.$field)}}</th>
                                                    @endforeach
                                                    <th></th>
                                                    {{--<th  >{{__('message.name')}}</th>
                                                    <th >{{__('message.mobile')}}</th>
                                                    <th >{{__('message.email')}}</th>
                                                    <th >{{__('message.customer.score')}}</th>
                                                    <th >{{__('message.customer.level')}}</th>
                                                    <th>{{__('message.customer.reagent')}}</th>
                                                    <th >{{__('message.customer.register_date')}}</th>
                                                    <th>{{__('message.branch_registered')}}</th>
                                                    <th >{{__('message.action')}}</th>--}}
                                                </tr>
                                                {{--<tr class="text-center filter" >

                                                    <th ><input type="text" id="fname" class="form-control" placeholder="{{__('message.name')}}"> </th>
                                                    <th ><input type="number"  minlength="11" maxlength="11" id="mobile" class="form-control" placeholder="{{__('message.mobile')}}"></th>
                                                    <th><input type="text" id="email" class="form-control" placeholder="{{__('message.email')}}"></th>

                                                    <th  colspan="3" ><select class="select2-placeholder-multiple form-control select2-hidden-accessible"  data-placeholder="{{__('message.customer.level')}}" multiple="" id="levels" tabindex="-1" aria-hidden="true" name="levels[]" style="width: 100%">
                                                            @foreach($levels as $level)
                                                                <option value="{{$level->id}}">{{$level->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th  colspan="2" ><div style="display: -webkit-box;"><input type="text" id="fromdate" class="form-control col-md-6" placeholder="از تاریخ"  ><input type="text" id="todate" class="form-control col-md-6"  placeholder="تا تاریخ"></div></th>

                                                    <th >
                                                        <button class="btn btn-primary btn-filter"  ><i class="ft-filter"></i></button>

                                                    </th>

                                                </tr>--}}
                                                </thead>
                                                <tbody class="customerslist">
                                                        @include('layout.admin.customlist.customlistrows')
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
    <section id="customersinfos">
        {{--@include('layout.admin.customers.customerinfo')--}}
    </section>
@endsection


@section('CustomJS')

    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>
    <script id="chart" src="{{ URL::asset('app-assets/vendors/js/charts/chart.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/toastr.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/pickers/dateTime/persianDatepicker.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/pickers/dateTime/prism.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script id="modalsc" src="{{ URL::asset('app-assets/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>
    <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/customlistrows.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endsection













