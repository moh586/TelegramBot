
@extends('layout.mainlayout')
@php
    include(app_path().'/Includes/jdf.php');
@endphp

@section('template_title')
    {{ __('message.page.editcustomerlist')}}
@endsection


@section('CustomCSS')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/icheck.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/icheck/custom.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/bootstrap-switch.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/toggle/switchery.min.css')}}">
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
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/validation/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/switch.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/checkboxes-radios.css')}}">
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
                    <h2 class="content-header-title mb-0 ">{{__('message.customerlist.edit',['name'=>$list->name])}}</h2>

                </div>

            </div>
            @if (session()->has('success'))
                <script type="text/javascript">
                    window.onload=function(){
                        //toastr.success('hi');
                        toastr.success('{{ session()->get('success') }}');
                    };

                </script>
            @elseif(session()->has('errors'))
                <script type="text/javascript">
                    window.onload=function(){
                        //toastr.success('hi');
                        toastr.error('{{ session()->get('errors') }}');
                    };

                </script>
            @endif
                <div class="content-body">
                    <form method="post" class="form" action="{{route('customlist.update',["id"=>$list->id])}}" novalidate>
                        @csrf
                        <input type="hidden" name="list_token" value="{{$list->token}}">
                        <div class="row ">
                            <div class="col-xl-4 col-lg-12 ">
                                <div class="card  bg-transparent" >
                                        <div class="card-body p-1  ">
                                            <h4 class="form-section"><i class="la la-edit "></i> {{__('message.customerlist.name')}}</h4>
                                            <fieldset class="form-group position-relative has-icon-left p-0 mb-0">
                                                <input required  type="text" class="form-control form-control-xl input-xl " value="{{$list->name}}" id="listname" name="listname" placeholder="{{__('message.customerlist.name')}}">
                                                <div class="form-control-position">
                                                    <i class="icon-pencil  font-medium-4"></i>
                                                </div>
                                            </fieldset>
                                        </div>
                                </div>
                            </div>
                            <div class="col-xl-8 col-lg-12 ">
                                <div class="card  bg-transparent" >
                                        <div class="card-body p-1  ">
                                            <h4 class="form-section"><i class="la la-eye "></i> {{__('message.customerlist.columns')}}</h4>
                                            @php
                                                $fields=explode(',',$list->fields);
                                            @endphp
                                            <div class="row skin skin-square ">
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11" name="field[]" value="first_name" @php if(in_array('first_name',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.first_name')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]" value="last_name" @php if(in_array('last_name',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.last_name')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"   value="email" @php if(in_array('email',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.email')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"   value="mobile" @php if(in_array('mobile',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.mobile')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="level" @php if(in_array('level',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.level')}}</label>
                                                    </fieldset>
                                                </div>

                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="gender" @php if(in_array('gender',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.gender')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="score" @php if(in_array('score',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.score')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="branch" @php if(in_array('branch',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.branch')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="operator" @php if(in_array('operator',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.operator')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="created_at" @php if(in_array('created_at',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.created_at')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="pc" @php if(in_array('pc',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.pc')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="scs" @php if(in_array('scs',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.scs')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="sps" @php if(in_array('sps',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.sps')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="lv" @php if(in_array('lv',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.lv')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="sgc" @php if(in_array('sgc',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.sgc')}}</label>
                                                    </fieldset>
                                                </div>
                                                <div class="col-xl-3 col-lg-6 col-md-12">
                                                    <fieldset>
                                                        <input type="checkbox" id="input-11"  name="field[]"  value="rc" @php if(in_array('rc',$fields)) echo "checked"  @endphp>
                                                        <label for="input-11">{{__('message.customerlist.list.rc')}}</label>
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>

                                </div>
                            </div>

                        </div>
                        <div class="row ">
                            <div class="col-12">
                                <h4 class="form-section"><i class="la la-filter "></i> {{__('message.customerlist.filter')}}</h4>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                            <input type="checkbox"  class="switchery filtery" name="filter[]" value="1" @if($list->hasFilter(1)) {{ "checked" }}  @endif />
                                            <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.name')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(1)) {{ "show" }} @endif">
                                        <div class="card-body p-1"  >
                                            <fieldset class="form-group mb-0">
                                                <input type="text" class="form-control filtername" id="filtername" name="filtername" value="@if($list->hasFilter(1)) {{$list->getFilter(1)[0] }} @endif">
                                            </fieldset>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery"  name="filter[]" value="2"  @if($list->hasFilter(2)) {{ "checked" }}  @endif   />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.scored')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(2)) {{ "show" }} @endif ">
                                        <div class="card-body p-1"  >
                                            <div class="row">
                                                <div class="col-6">
                                                <fieldset class="form-group mb-0">
                                                    <input type="text" class="form-control" id="basicInput" name="minscored" value="@if($list->hasFilter(2)) {{$list->getFilter(2)[0]=="-1"?"":$list->getFilter(2)[0] }} @endif">
                                                </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="maxscored" value="@if($list->hasFilter(2)) {{$list->getFilter(2)[1]=="-1"?"":$list->getFilter(2)[1] }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="3"  @if($list->hasFilter(3)) {{ "checked" }}  @endif/>
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.spended')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(3)) {{ "show" }} @endif ">
                                        <div class="card-body p-1" >
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="minspended" value="@if($list->hasFilter(3)) {{$list->getFilter(3)[0]=="-1"?"":$list->getFilter(3)[0] }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="maxspended" value="@if($list->hasFilter(3)) {{$list->getFilter(3)[1]=="-1"?"":$list->getFilter(3)[1] }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="4"  @if($list->hasFilter(4)) {{ "checked" }}  @endif/>
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.presence')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(4)) {{ "show" }} @endif ">
                                        <div class="card-body p-1" >
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="minpresence" value="@if($list->hasFilter(4)) {{$list->getFilter(4)[0]=="-1"?"":$list->getFilter(4)[0] }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="maxpresence" value="@if($list->hasFilter(4)) {{$list->getFilter(4)[1]=="-1"?"":$list->getFilter(4)[1] }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="5"  @if($list->hasFilter(5)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.lastpresence')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(5)) {{ "show" }} @endif ">
                                        <div class="card-body p-1"  id="filterbynamebody">
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control persiancalander" id="lastpresencemin" name="minlastpresence" value="@if($list->hasFilter(5)) {{$list->getFilter(5)[0]=="-1"?"":jdate("Y/n/j",$list->getFilter(5)[0]) }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control persiancalander" id="lastpresencemax" name="maxlastpresence" value="@if($list->hasFilter(5)) {{$list->getFilter(5)[1]=="-1"?"":jdate("Y/n/j",$list->getFilter(5)[1]) }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="6"  @if($list->hasFilter(6)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.registred')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(6)) {{ "show" }} @endif ">
                                        <div class="card-body p-1"  >
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control persiancalander" id="registeredmin" name="minregistred" value="@if($list->hasFilter(6)) {{$list->getFilter(6)[0]=="-1"?"":jdate("Y/n/j",$list->getFilter(6)[0]) }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control persiancalander" id="registeredmax" name="maxregistred" value="@if($list->hasFilter(6)) {{$list->getFilter(6)[1]=="-1"?"":jdate("Y/n/j",$list->getFilter(6)[1]) }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="7"  @if($list->hasFilter(7)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.presenceoneday')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(7)) {{ "show" }} @endif ">
                                        <div class="card-body p-1" >
                                            <div class="row">
                                                <div class="col-12">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control persiancalander"  name="presenceoneday" value="@if($list->hasFilter(7)) {{$list->getFilter(7)[0]=='-1'?'':jdate('Y/n/j',$list->getFilter(7)[0]) }} @endif ">
                                                    </fieldset>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="8" @if($list->hasFilter(8)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.gender')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(8)) {{ "show" }} @endif">
                                        <div class="card-body p-1" >
                                            <div class="row">
                                                <div class="col-12">
                                                    <fieldset class="form-group mb-0 text-center">
                                                        <input type="checkbox"  name="gender" class="switch gender" data-on-label="{{__('message.mail')}}" data-off-label="{{__('message.femail')}}"
                                                               id="switch12" @if($list->hasFilter(8)) {{$list->getFilter(8)[0]==1?"checked":"" }} @endif />
                                                    </fieldset>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="9"  @if($list->hasFilter(9)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.giftcount')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(9)) {{ "show" }} @endif">
                                        <div class="card-body p-1" >
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="mingift" value="@if($list->hasFilter(9)) {{$list->getFilter(4)[0]=="-1"?"":$list->getFilter(9)[0] }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="maxgift" value="@if($list->hasFilter(9)) {{$list->getFilter(9)[1]=="-1"?"":$list->getFilter(9)[1] }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="10"  @if($list->hasFilter(10)) {{ "checked" }}  @endif  />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.gifttype')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(10)) {{ "show" }} @endif">
                                        <div class="card-body p-1"  >
                                            <div class="row">
                                                <div class="col-12">
                                                    <select class="select2-placeholder-multiple form-control select2-hidden-accessible"  data-placeholder="{{__('message.customer.level')}}" multiple="" id="levels" tabindex="-1" aria-hidden="true" name="gifts[]" style="width: 100%">
                                                        @foreach($gifts as $gift)
                                                            <option value="{{$gift->id}}" @if($list->hasFilter(10)&& in_array($gift->id,$list->getFilter(10))){{"selected"}}  @endif >{{$gift->title}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="11"  @if($list->hasFilter(11)) {{ "checked" }}  @endif/>
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.level')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(11)) {{ "show" }} @endif">
                                        <div class="card-body p-1"  >
                                            <div class="row">
                                                <div class="col-12">
                                                    <select class="select2-placeholder-multiple form-control select2-hidden-accessible"  data-placeholder="{{__('message.customer.level')}}" multiple="" id="levels" tabindex="-1" aria-hidden="true" name="levels[]" style="width: 100%">
                                                        @foreach($levels as $level)
                                                            <option value="{{$level->id}}"  @if($list->hasFilter(11)&& in_array($level->id,$list->getFilter(11))){{"selected"}}  @endif >{{$level->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="12"  @if($list->hasFilter(12)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.reagent')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(12)) {{ "show" }} @endif">
                                        <div class="card-body p-1">
                                            <div class="row">
                                                <div class="col-6">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="minagent" value="@if($list->hasFilter(12)) {{$list->getFilter(12)[0]=="-1"?"":$list->getFilter(12)[0] }} @endif">
                                                    </fieldset>
                                                </div>
                                                <div class="col-6 float-right">
                                                    <fieldset class="form-group mb-0">
                                                        <input type="text" class="form-control" id="basicInput" name="maxagent" value="@if($list->hasFilter(12)) {{$list->getFilter(12)[1]=="-1"?"":$list->getFilter(12)[1] }} @endif">
                                                    </fieldset>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4 col-lg-6 col-md-12">
                                <div class="card" >
                                    <div class="card-header p-1">

                                        <input type="checkbox"  class="switchery filtery" name="filter[]" value="13"  @if($list->hasFilter(13)) {{ "checked" }}  @endif />
                                        <label for="switchery" class="font-medium-2 text-bold-600 ml-1">{{__('message.customerlist.filter.branch')}}</label>


                                    </div>
                                    <div class="card-content collpase collapse @if($list->hasFilter(13)) {{ "show" }} @endif">
                                        <div class="card-body p-1"  >
                                            <div class="row">
                                                <div class="col-12 text-center">

                                                    <select class="select2-placeholder-multiple form-control" multiple="multiple" id="multi_placehodler"  data-placeholder="{{__('message.customer.level')}}"  id="levels"  name="branchs[]" style="width: 100%">
                                                        @foreach($branchs as $branch)
                                                            <option value="{{$branch->id}}" @if($list->hasFilter(13)&& in_array($level->id,$list->getFilter(13))){{"selected"}}  @endif >{{$branch->name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-actions center">
                                    <button type="button" class="btn btn-warning mr-1" data-href="{{route('customlist.list')}}"  >
                                        <i class="la la-close"></i> {{__('message.cancel')}}
                                    </button>
                                    <button type="submit" class="btn btn-primary" {{--onclick="document.getElementById('createbranch').submit()"--}} >
                                        <i class="la la-check-square-o"></i> {{__('message.save')}}
                                    </button>
                                </div>
                            </div>
                        </div>

                    </form>
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
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-checkbox.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/switchery.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/checkbox-radio.js')}}" ></script>
    <script id="modalsc" src="{{ URL::asset('app-assets/js/scripts/modal/components-modal.js') }}" type="text/javascript"></script>
    <script id="mainsc" src="{{ URL::asset('app-assets/js/scripts/blades/createcustomerlist.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endsection













