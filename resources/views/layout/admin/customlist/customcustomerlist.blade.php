
@extends('layout.mainlayout')
@php
    include(app_path().'/Includes/jdf.php');
    $colors=['primary','danger','success','warning','info','red','pink','purple','blue','cyan','teal','yellow','amber','blue-grey'];
@endphp

@section('template_title')
    {{ __('message.page.customcustomerlist')}}
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/fonts/simple-line-icons/style.min.css') }}">
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
                    <h2 class="content-header-title mb-0 ">{{__('message.page.customcustomerlist')}}</h2>

                </div>

            </div>

                <div class="content-body">
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
                    <section id="minimal-statistics">
                            <div class="row">
                                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                                    <h3 class="content-header-title mb-0 d-inline-block">@if($lists->count()==0)  {{ __('message.customerlist.any')}}@else {{ __('message.customerlist.count',['count'=>$lists->count()])}}@endif </h3>

                                </div>
                                <div class="content-header-right col-md-6 col-12">
                                    <div class="dropdown float-md-right">
                                        <button type="button" class="btn btn-float btn-float-lg btn-outline-pink" data-href="{{route('customlist.create')}}" id="createlist"><i class="la la-plus"></i>
                                            <span>{{__('message.customerlist.create')}}</span>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-4">
                                @foreach($lists as $list)
                                    <div class="col-xl-3 col-lg-6 col-12">
                                        @php
                                            $color=$colors[rand(1,count($colors)-1)];
                                            $listcount=$list->getCustomerList()->get()->count();
                                            $percent=round($listcount*100/$customers_count)
                                        @endphp
                                        <div class="card rightclick">
                                            <div class="card-content">
                                                <div class="card-body">
                                                    <div class="media d-flex">
                                                        <div class="media-body text-left">
                                                            <h3 class="{{$color}}">{{$listcount}}</h3>
                                                            <a href="{{route('customlist.customer',['id'=>$list->id])}}"><h6 class="mb-0">{{$list->name}}</h6></a>
                                                        </div>
                                                        <div class="align-self-center">
                                                            <span class="dropdown">
                                                                <button  type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                        aria-expanded="false" class="btn btn-{{$color}} dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5  open-left" >
                                                                    <a href="{{route('customlist.edit',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.edit')}} <i class="la la-edit"></i> </a>
                                                                    <a href="{{route('customlist.customer',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.view')}} <i class="la la-list-ul"></i> </a>
                                                                    <a href="{{route('customlist.destroy',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.delete')}} <i class="la la-trash-o"></i> </a>

                                                                </span>
                                                            </span>
                                                          {{--  <i class="icon-list {{$color}} font-large-2 float-right"></i>--}}
                                                        </div>
                                                    </div>
                                                    <div class="progress mt-1 mb-0" style="height: 7px;">
                                                        <div class="progress-bar bg-{{$color}}" role="progressbar" style="width: {{$percent}}%" aria-valuenow="{{$percent}}"
                                                             aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu dropdown-menu-sm" id="context-menu">
                                                <a href="{{route('customlist.edit',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.edit')}} <i class="la la-edit"></i> </a>
                                                <a href="{{route('customlist.customer',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.view')}} <i class="la la-list-ul"></i> </a>
                                                <a href="{{route('customlist.destroy',['id'=>$list->id])}}" class="dropdown-item">  {{__('message.customerlist.list.delete')}} <i class="la la-trash-o"></i> </a>
                                            </div>
                                        </div>
                                    </div>

                                @endforeach

                            </div>

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
    <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/customlists.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endsection













