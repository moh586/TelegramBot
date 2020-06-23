
@extends('layout.mainlayout')
{{--@php
    include(app_path().'/Includes/jdf.php');
@endphp--}}

@section('template_title')
    {{ __('message.page.levellist')}}
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">

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
                        @if($enableChart)
                            <div class="col-xl-4 col-lg-12">
                                <div class="card  bg-blue bg-lighten-3 rounded-top">
                                    <div class="card-content">
                                        {!! $piechart->container() !!}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col">
                            <div class="card">
                                <div class="card-head">
                                    <div class="card-header">
                                        <div class="heading-elements">
                                            <button type="button" class="btn btn-float btn-float-md btn-outline-pink"
                                                    id="createlevel" data-toggle="modal" data-target="#CreateLevel"><i class="la la-plus"></i>
                                               {{-- <span>{{__('message.customerlist.create')}}</span>--}}
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-content mt-2">
                                    <div class="card-body">
                                        <!-- Task List table -->
                                        <div class="table-responsive">
                                            <table id="users-contacts"  class="table table-striped table-bordered base-style dataTable ">
                                                    <thead>
                                                    <tr class="text-center">
                                                        <th> </th>
                                                        <th>{{__('message.level.name')}}</th>
                                                        <th>{{__('message.level.score')}}</th>
                                                        <th>{{__('message.level.description')}}</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="customerslist">
                                                    @foreach($levels as $level)
                                                    <tr>
                                                        <td  class=text-center">
                                                            @if($level->score!=0)
                                                                <a data-toggle="modal" data-value="{{$level->id}}" data-score="{{$level->score}}"
                                                                   data-name="{{$level->name}}" data-description=" {{$level->description}}"
                                                                   data-target="#DeleteLevel" class="danger delete"><i class="ft-trash-2"></i>
                                                                </a>
                                                            @endif
                                                            <a data-toggle="modal" data-value="{{$level->id}}" data-score="{{$level->score}}"
                                                               data-name="{{$level->name}}" data-description=" {{$level->description}}"
                                                               data-target="#EditLevel" class="teal edit mr-1"><i class="ft-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td  class="text-center ">
                                                            {{$level->name}}
                                                        </td>
                                                        <td  class="text-center ">
                                                            {{$level->score}}
                                                        </td>
                                                        <td  class="text-center ">
                                                            {{$level->description}}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>


        </div>
    </div>
    <div class="modal fade text-left" id="EditLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; " aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="level-form">
                    <form id="form-edit-level" class="contact-input" novalidate method="post"
                          action="{{route('level.update')}}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('message.level.update')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="lid" name="lid" >
                            <fieldset class="form-group col-12">
                                <input  required  type="text" id="name" name="name" class="form-control" placeholder="{{__('message.level.name')}}"
                                        data-validation-required-message="{{__('message.necessary')}}" >
                                <div class="help-block"></div>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input    type="text" id="description" name="description" class="form-control "  placeholder="{{__('message.level.description')}}"
                                >
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input  required  type="number" id="score" name="score" class="form-control ltr" placeholder="{{__('message.level.score')}}"
                                        data-validation-required-message="{{__('message.necessary')}}" >
                                <div class="help-block"></div>
                            </fieldset>
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
    <div class="modal fade text-left" id="DeleteLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; " aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="level-form">
                    <form method="post" id="form-delete-level" class="contact-input"  action="{{route('level.destroy')}}" >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{__('message.level.destroy')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" id="lid" name="lid" >
                            <fieldset class="form-group col-12">
                                <input    type="text" id="name" name="name" class="form-control" readonly  >
                                <div class="help-block"></div>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input    type="text" id="description" name="description" class="form-control "  readonly  >
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input  required  type="number" id="score" name="score" class="form-control ltr" readonly >
                                <div class="help-block"></div>
                            </fieldset>
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
    <div class="modal fade text-left" id="CreateLevel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none; " aria-modal="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <section class="contact-form">
                    <form method="post" id="form-new-level" action="{{route('level.store')}}" novalidate >
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" >{{__('message.level.new')}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">

                            <fieldset class="form-group col-12">
                                <input  required  type="text" id="name" name="name" class="form-control" placeholder="{{__('message.level.name')}}"
                                        data-validation-required-message="{{__('message.necessary')}}" >
                                <div class="help-block"></div>
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input    type="text" id="description" name="description" class="form-control "  placeholder="{{__('message.level.description')}}"
                                          >
                            </fieldset>
                            <fieldset class="form-group col-12">
                                <input  required  type="number" id="score" name="score" class="form-control ltr" placeholder="{{__('message.level.score')}}"
                                        data-validation-required-message="{{__('message.necessary')}}" >
                                <div class="help-block"></div>
                            </fieldset>


                        </div>
                        <div class="modal-footer">
                            <fieldset class="form-group position-relative has-icon-left mb-0">
                                <button type="submit"  class="btn btn-success " ><i class="fa fa-paper-plane-o d-lg-none"></i> <span class="d-none d-lg-block">{{__('message.save')}}</span></button>
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
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->

    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script id="modalsc" src="{{ URL::asset('app-assets/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>
    <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/levelist.js') }}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highcharts/6.0.6/highcharts.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js" charset="utf-8"></script>

    @if($enableChart){!! $piechart->script() !!} @endif

    <!-- END PAGE LEVEL JS-->

@endsection













