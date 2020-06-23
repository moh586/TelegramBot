@extends('layout.mainlayout')

@section('template_title')
   {{__('message.page.allbranch')}}
@endsection

@section('CustomCSS')
    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">
    <link rel="stylesheet" type="text/css" href="{{URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
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
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.branchs')}}</h2>

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
                    @endif
                    <section class="row">
                        <div class="col-12">
                            <div class="card">

                                <div class="card-head">
                                    <div class="card-header">
                                        <h3 class="card-title">{{__('message.page.allbranch')}}</h3>
                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                        <div class="heading-elements">
                                            <button class="btn btn-primary btn-sm" data-href="{{route('branch.create')}}"><i class="ft-plus white"></i> {{__('message.add_branch')}}</button>
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
                                                    <th>{{__('message.address')}}</th>
                                                    <th>{{__('message.email')}}</th>
                                                    <th></th>

                                                </tr>
                                                </thead>
                                                <?php $branchs=Auth::user()->getBranchs();  ?>
                                                <tbody>
                                                @forelse($branchs as $branch)

                                                    <tr >
                                                        <td class="text-center">
                                                            {{$branch->name}}
                                                        </td>
                                                        <td class="text-center">
                                                            {{$branch->address}}
                                                        </td>

                                                        <td class="text-center">
                                                            {{$branch->email}}
                                                        </td>
                                                        <td class="text-center">
                                                            <button class="btn btn-primary btn-edit" data-href="{{route('branch.edit',['id'=>$branch->id])}}"><i class="ft-edit"></i> </button>
                                                        </td>


                                                    </tr>

                                                @empty
                                                    <tr><td colspan="3" class="text-center">{{__('message.nobranch')}}</td> </tr>
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
    <script src="{{ URL::asset('app-assets/js/scripts/blades/branchlist.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->

@endsection
