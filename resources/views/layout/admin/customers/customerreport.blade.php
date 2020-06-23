
@extends('layout.mainlayout')
{{--@php
    include(app_path().'/Includes/jdf.php');
@endphp--}}

@section('template_title')
    {{ __('message.page.reportcustomer')}}
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
           {{-- <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.customers')}}</h2>

                </div>

            </div>
--}}              @if (session()->has('success'))
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
                <div class="content-body">
                    <div class="row">
                        <div class="col-xl-3 col-lg-12">
                            <div class="card card border-teal border-lighten-2"   id="resultcard" >
                                <div class="text-center">
                                    <div class="card-body">
                                        <img src="/storage/avatars/{{$customer->avatar}}" class="rounded-circle  height-150" alt="Card image" id="avatar">
                                    </div>
                                    <div class="card-body">
                                        <h4 class="card-title" id="name">{{$customer->getFullName()}}</h4>
                                        <h6 class="card-subtitle text-muted" id="level">{{$customer->getLevel()->name}}</h6>
                                    </div>
                                    <div class="card-body">
                                        {{--<button type="button" class="btn btn-warning mr-1" data-href="{{route('customerslist')}}"  >
                                            <i class="ft-x"></i> {{__('message.cancle')}}
                                        </button>
                                        <button type="button" class="btn btn-primary  mr-1" data-href="1"  >
                                            <i class="ft-check-square"></i> {{__('message.customer_edit')}}
                                        </button>--}}
                                        {{-- <button type="button" class="btn btn-danger mr-1"><i class="la la-plus"></i> Follow</button>
                                         <button type="button" class="btn btn-primary mr-1"><i class="ft-user"></i> Profile</button>--}}
                                    </div>
                                </div>
                                <div class="list-group list-group-flush">
                                    <a href="#" id="phone" class="list-group-item p-1"><i class="la la-phone"></i>  {{$customer->mobile}}</a>
                                    <a href="#" id="email" class="list-group-item p-1"><i class="la la-paper-plane"></i>  {{$customer->email}}</a>
                                    <a href="#" id="activity" class="list-group-item p-1"><i class="la la-venus"></i>  {{ Lang::get('message.customer_trnsaction_time',['time'=>$transactions_count])}}</a>
                                    <a href="#" id="score" class="list-group-item p-1"> <i class="la la-gift"></i>  {{$customer->score}}</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-lg-12">
                            <div class="card">
                                {{--<div class="card-head">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('message.page.allcustomer')}}</h3>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <button class="btn btn-primary btn-sm" data-href="{{route('customer.create')}}"><i class="ft-plus white"></i> {{__('message.add_customer')}}</button>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="card-content">
                                    <div class="card-body">
                                        <!-- Task List table -->
                                        <div class="table-responsive">
                                            <table id="users-contacts"  class="table table-striped table-bordered base-style dataTable font-small-2">
                                                <thead>
                                                <tr class="text-center">
                                                    <th colspan="2" style="width: 27%"  >{{__('message.customer.branch')}}</th>
                                                    <th style="width: 22%" >{{__('message.customer.operator')}}</th>
                                                    <th style="width: 7%">{{__('message.customer.score')}}</th>
                                                    <th colspan="2" style="width: 33%">{{__('message.customer.description')}}</th>
                                                    {{--<th style="width: 12%">{{__('message.customer.transaction.date')}}</th>--}}
                                                    <th style="width: 12%" ><i class="la la-file-pdf-o font-large-1"></i><i class="la la-file-excel-o font-large-1"></i> </th>
                                                </tr>
                                                <tr class="text-center filter" >
                                                    <th  colspan="2" >
                                                        <select class="select2-placeholder-multiple form-control select2-hidden-accessible"  data-placeholder="{{__('message.customer.level')}}" multiple="" id="branchs" tabindex="-1" aria-hidden="true" name="branchs[]" style="width: 100%">
                                                            @foreach($Branchs as $branch)
                                                                <option value="{{$branch->id}}">{{$branch->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </th>
                                                    <th  colspan="2" ><div style="display: -webkit-box;"><input type="text" id="fromscore" class="form-control col-md-6" placeholder="{{__('message.customers.startscore')}}"  ><input type="text" id="toscore" class="form-control col-md-6"  placeholder="{{__('message.customers.endscore')}}"></div></th>
                                                    <th  colspan="2" ><div style="display: -webkit-box;"><input type="text" id="fromdate" class="form-control col-md-6" placeholder="{{__('message.customers.startdate')}}"  ><input type="text" id="todate" class="form-control col-md-6"  placeholder="{{__('message.customers.enddate')}}"></div></th>

                                                    <th >
                                                        <button class="btn btn-primary btn-filter font-small-2"  ><i class="ft-filter"></i></button>

                                                    </th>

                                                </tr>
                                                </thead>
                                                <tbody class="customerslist">
                                                    @include('layout.admin.customers.customerreportsrows')
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @if($chartenable[0])
                        <div class="col-xl-4 col-lg-12">
                            <div class="card pt-2">
                                <div class="card-content">
                                    <ul class="nav nav-tabs nav-top-border no-hover-bg">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="month-tab1" data-toggle="tab" href="#month" aria-controls="month"
                                               aria-expanded="true">{{__('message.customer.report.month')}}</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link " id="year-tab1" data-toggle="tab" href="#year" aria-controls="year"
                                               aria-expanded="false">{{__('message.customer.report.year')}}</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content px-1 pt-1">
                                        <div role="tabpanel" class="tab-pane active" id="month" aria-labelledby="month-tab1" aria-expanded="true">
                                           {!! $monthchart->container()  !!}
                                        </div>
                                        <div class="tab-pane " id="year" role="tabpanel" aria-labelledby="year-tab1"
                                             aria-expanded="false">
                                            @if($chartenable[1]){!! $yearchart->container() !!} @endif
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @endif
                        @if($chartenable[2])
                        <div class="col-xl-4 col-lg-12">
                            <div class="card  bg-blue bg-lighten-3 rounded-top">
                                <div class="card-content">
                                     {!! $branchchart->container() !!}
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($chartenable[3])
                        <div class="col-xl-4 col-lg-12">
                            <div class="card">
                                <div class="card-content bg-success">
                                     {!! $giftchart->container() !!}
                                </div>
                                <div class="card-footer">
                                    <div class="chart-title mb-1">
                                        <span class="text-muted">Total mobile units sold and total earning statistics.</span>
                                    </div>
                                    <ul class="list-inline text-center clearfix mt-2">
                                        <li class="mr-3">
                                            <span class="text-muted">Total Units Sold</span>
                                            <h2 class="block">18.6 k</h2>
                                        </li>
                                        <li>
                                            <span class="text-muted">Total Earnings</span>
                                            <h2 class="block">64.54 M</h2>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                    @if($chartenable[4])
                    <div class="row">
                        <div class="col-12">
                            <div class="card pt-2">
                                <div class="card-content">
                                     {!! $scorechart->container() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>


        </div>
    </div>
    <div class="modal fade text-left" id="EditTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; " aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="transaction-form">
                    <form id="form-edit-transaction" class="contact-input" novalidate method="post" action="{{route('customer.edit.transaction',['id'=>$customer->id])}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('message.customer.transaction.edit')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="tid" name="tid" >
                            <fieldset class="form-group col-12">
                                <input  required  type="number" id="score" name="score" class="number form-control ltr" placeholder="{{__('message.customer.score')}}" >
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="branch" class=" form-control" readonly>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="operator" class=" form-control" readonly>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="date" class=" form-control" readonly>
                            </fieldset>
                            <span id="fav" class="d-none">active</span>
                        </div>
                        <div class="modal-footer">
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button type="submit" id="edit-contact-item" class="btn btn-teal edit-contact-item" ><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">{{__('message.edit')}}</span></button>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button type="button" id="cancel-contact-item" class="btn btn-warning cancel" data-dismiss="modal"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">{{__('message.cancel')}}</span></button>
                            </fieldset>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <div class="modal fade text-left" id="DeleteTransaction" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; " aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="contact-form">
                    <form method="post" id="form-delete-transaction" class="contact-input" action="{{route('customer.delete.transaction',['id'=>$customer->id])}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('message.customer.transaction.delete')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="tid"  name="tid">
                            <fieldset class="form-group col-12">
                                <input  required  type="number" id="score" class="number form-control ltr" readonly >
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="branch" class=" form-control" readonly>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="operator" class=" form-control" readonly>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input type="text" id="date" class=" form-control" readonly>
                            </fieldset>
                            <span id="fav" class="d-none">active</span>
                        </div>
                        <div class="modal-footer">
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button type="submit" id="delete-contact-item" class="btn btn-danger delete-contact-item" ><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">{{__('message.delete')}}</span></button>
                            </fieldset>
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button type="button" id="cancel-contact-item" class="btn btn-warning cancel" data-dismiss="modal"><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">{{__('message.cancel')}}</span></button>
                            </fieldset>
                        </div>
                    </form>
                </section>
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
    <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/customerreports.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    @if($chartenable[0]){!! $monthchart->script() !!} @endif
    @if($chartenable[1]){!! $yearchart->script() !!} @endif
    @if($chartenable[2]){!! $branchchart->script() !!} @endif
    @if($chartenable[3]){!! $giftchart->script() !!} @endif
    @if($chartenable[4]){!! $scorechart->script() !!} @endif
    <!-- END PAGE LEVEL JS-->

@endsection













