@extends('layout.mainlayout')

@section('template_title')
    {{__('message.page.alloperator')}}
@endsection
@section('CustomCSS')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
    <!-- END VENDOR CSS-->

    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/css-rtl/plugins/extensions/toastr.css')}}">
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
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.operators')}}</h2>

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
                                        <h3 class="card-title">{{__('message.page.alloperator')}}</h3>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <button class="btn btn-primary btn-sm" data-href="{{route('user.create')}}"><i class="ft-plus white"></i> {{__('message.add_operator')}}</button>
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
                                                    <th>{{__('message.name')}}</th>
                                                    <th>{{__('message.username')}}</th>
                                                    <th>{{__('message.role')}}</th>
                                                    <th>{{__('message.mobile')}}</th>
                                                    <th>{{__('message.email')}}</th>
                                                    <th>{{__('message.branch')}}</th>
                                                    <th>{{__('message.status')}}</th>
                                                    <th>{{__('message.action')}}</th>
                                                </tr>
                                                </thead>
                                                <?php $users=Auth::user()->getBusiness()->getUsers();  ?>
                                                <tbody>
                                                @forelse($users as $user)
                                                    @if($user->id != Auth::user()->id)
                                                    <tr @if($user->activated==0) class="alert alert-dark mb-2" @endif >
                                                        <td class="text-center">
                                                            {{$user->first_name}} {{$user->last_name}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$user->name}}
                                                        </td>
                                                        <td class="text-center">
                                                            <?php $roles=$user->getRoles(); ?>

                                                                 <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" >
                                                                    <span class="selection">
                                                                        <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" style="border: 0px;background: transparent">
                                                                            <ul class="select-selection__rendered">
                                                                                @foreach($roles as $role)
                                                                                    <li class="select2-selection__choice" title="{{$role->name}}">
                                                                                        <span class="select2-selection__choice__remove" role="presentation"></span>{{$role->name}}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </span>
                                                                    </span>
                                                                 </span>

                                                        </td>
                                                        <td class="text-center">
                                                            {{$user->mobile}}
                                                        </td>
                                                        <td class="text-center">
                                                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php $branches=$user->getBranchs(); ?>

                                                                <span class="select2 select2-container select2-container--default select2-container--below select2-container--focus" dir="ltr" >
                                                                    <span class="selection">
                                                                        <span class="select2-selection select2-selection--multiple" role="combobox" aria-haspopup="true" aria-expanded="false" tabindex="-1" style="border: 0px;background: transparent">
                                                                            <ul class="select2-selection__rendered">
                                                                                @foreach($branches as $branche)
                                                                                    <li class="select2-selection__choice" title="{{$branche->name}}" >
                                                                                        <span class="select2-selection__choice__remove" role="presentation" data-val1="{{$branche->id}}" data-val2="{{$user->id}}"> × </span>{{$branche->name}}
                                                                                    </li>
                                                                                @endforeach
                                                                            </ul>
                                                                        </span>
                                                                    </span>
                                                                </span>

                                                        </td>
                                                        <td class="text-center">
                                                            @if($user->activated==0)
                                                                <span class="badge badge-danger">{{__('message.status.deactive')}}</span>
                                                            @else
                                                                <span class="badge badge-success">{{__('message.status.active')}}</span>
                                                            @endif

                                                        </td>
                                                        <td>
                                                            <span class="dropdown">
                                                                <button id="btnSearchDrop2" type="button" data-toggle="dropdown" aria-haspopup="true"
                                                                    aria-expanded="true" class="btn btn-primary dropdown-toggle dropdown-menu-right"><i class="ft-settings"></i></button>
                                                                <span aria-labelledby="btnSearchDrop2" class="dropdown-menu mr-5 open-left">
                                                                    <a href="{{route('user.edit',['id'=>$user->id])}}" class="dropdown-item">  {{__('message.user.edit')}} <i class="ft-edit-2"></i> </a>
                                                                    <a href="{{route('user.destroy',['id'=>$user->id])}}" class="dropdown-item"> {{__('message.user.delete')}} <i class="ft-trash-2"></i> </a>
                                                                    <a href="{{route('user.status',['id'=>$user->id])}}" class="dropdown-item"> @if($user->activated==0){{__('message.status.active')}} @else {{__('message.status.deactive')}} @endif <i class="ft-disc"></i> </a>
                                                               </span>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                @empty
                                                    <tr><td colspan="6" class="text-center">{{__('message.nouser')}}</td> </tr>
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

@endsection

@section('CustomJS')

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
    <script src="{{ URL::asset('app-assets/js/scripts/blades/userlist.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endsection

