<!DOCTYPE html>

@section('template_title')
    Product List
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
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/ecommerce-shop.css')}}">
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
                    <h2 class="content-header-title mb-0 d-inline-block">Products</h2>
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
                    @elseif ($errors->any())
                        <script type="text/javascript">
                            window.onload=function(){
                                //toastr.success('hi');
                                @foreach ($errors->all() as $error)
                                    toastr.error('{{$error}}');
                                @endforeach
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
                                        <button class="btn btn-primary btn-sm" data-href="{{route('transaction_new')}}"><i class="ft-plus white"></i>Transaction</button>
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
                                                <th>Agent</th>
                                                <th>Customer </th>
                                                <th>Seller</th>
                                                <th>Product</th>
                                                <th>Quantity</th>
                                                <th>Extra</th>

                                            </tr>
                                            </thead>

                                            <tbody>
                                            @forelse($transactions as $transaction)
                                                <tr >
                                                    <td class="text-center p-0">{{$transaction->getAgent()->getFullName()}}                 </td>
                                                    <td class="text-center p-0">{{$transaction->getCustomer()->getFullName()}}              </td>
                                                    <td class="text-center p-0">{{$transaction->getProduct()->getSeller()->getFullName()}}  </td>
                                                    <td class="text-center p-0">{{$transaction->getProduct()->name}}                        </td>
                                                    <td class="text-center p-0">{{$transaction->quantity}}                                  </td>
                                                    <td class="text-center p-0">{{$transaction->extra}}                                     </td>
                                                </tr>

                                            @empty
                                                <tr><td colspan="6" class="text-center">No Transaction</td> </tr>
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
    <script src="{{ URL::asset('app-assets/js/scripts/blades/transaction-list.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->


    </body>
</html>

