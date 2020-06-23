<!DOCTYPE html>

@section('template_title')
    Add Product
@endsection
<html class="loading" lang="en" data-textdirection="ltr">
    <head>
        @include('layout.partials.head')
        <!-- BEGIN: Vendor CSS-->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/vendors.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/forms/selects/select2.min.css')}}">
   {{--     <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/ui/prism.min.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/vendors/css/file-uploaders/dropzone.min.css')}}">--}}
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
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/extensions/toastr.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/forms/wizard.css')}}">
     {{--   <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/plugins/file-uploaders/dropzone.css')}}">
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css/pages/dropzone.css')}}">--}}
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
                    <h2 class="content-header-title mb-0 d-inline-block">Add Product</h2>
                </div>

            </div>

            <div class="content-body">
                <section id="add-product">
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
                    <div class="icon-tabs">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Add Products</h4>
                                        <a href="#" class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                    </div>
                                    <div class="card-content collapse show">
                                        <div class="card-body">
                                            <form action="{{route('product_store')}}"  class="add-doctors-tabs icons-tab-steps steps-validation wizard-notification" method="post" enctype="multipart/form-data">
                                                @csrf
                                                <!-- step 1 => Personal Details -->

                                                <h6><i class="step-icon la la-newspaper-o font-medium-3"></i> Product Details</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="productname">Product Name:<span class="danger">*</span></label>
                                                                <input type="text" class="form-control required" id="productName" name="productname" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="lastName">Seller:<span class="danger">*</span></label>
                                                                <select class="select2-icon form-control" name="seller" id="seller" data-placeholder="Select Seller of Product">
                                                                    @if($sellers->count()>0)
                                                                        <option value="0">Select Seller of Product</option>
                                                                    @endif
                                                                    @forelse($sellers as $seller)
                                                                        <option value="{{$seller->id}}" data-icon="user">{{$seller->getFullName()}}</option>
                                                                    @empty
                                                                        <option  >{{$seller->getFullName()}}</option>
                                                                    @endforelse
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="address">Keywords:</label>
                                                                <input type="text" class="form-control" id="keywords" name="keywords">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="soldby">Sold By:</label>
                                                                <input type="text" class="form-control" id="soldby" name="soldby">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="brand">Brand:<span class="danger">*</span></label>
                                                                <input type="text" class="form-control required" id="brand" name="brand">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="productlink">Product Link:</label>
                                                                <input type="text" class="form-control" id="productlink" name="productlink">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="asin">ASIN:</label>
                                                                <input type="text" class="form-control" id="asin" name="asin">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="rate">No of Rating:</label>
                                                                <input type="number" class="form-control" id="rate" name="rate">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                                <!-- Step 2 => Education Details-->
                                                <h6><i class="step-icon la la-money font-medium-3"></i> Financial Details</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="price">Price:<span class="danger">*</span></label>
                                                                <input type="number" class="form-control required" id="price" name="price">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <label for="pay">Price to Pay:<span class="danger">*</span></label>
                                                                <input type="number" class="form-control required" id="pay" name="pay">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="instructions">Instructions:</label>
                                                                <input type="text" class="form-control" id="instructions" name="instructions">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="maxorder">Max Order Per Day:</label>
                                                                <input type="text" class="form-control " id="maxorder" name="maxorder">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="total">Total:</label>
                                                                <input type="text" class="form-control" id="total" name="total">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="coupon">Coupon:</label>
                                                                <input type="text" class="form-control" id="coupon" name="coupon">
                                                            </div>
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="commission">Commission:<span class="danger">*</span></label>
                                                                <input type="number" class="form-control required" id="commission" name="commission">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="refund">Refund Type:</label>
                                                                <input type="text" class="form-control" id="refund" name="refund">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label for="review">Review Type:</label>
                                                                <input type="text" class="form-control" id="review" name="review">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- Step 3 => Experience -->
                                                <h6><i class="step-icon font-medium-3 la la-openid"></i> Product Attribute</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="select2-tags">Color:</label>
                                                                <select  class="select2-tags form-control" multiple="" id="color" name="colors[]">
                                                                    <option value="black">black</option>
                                                                    <option value="white">white</option>
                                                                    <option value="purple" >purple</option>
                                                                    <option value="red">red</option>
                                                                    <option value="blue">blue</option>
                                                                    <option value="green">green</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="select2-tags">Size:</label>
                                                            <select  class="select2-tags form-control" multiple="" id="size" name="sizes[]">
                                                                <option value="small">Small</option>
                                                                <option value="medium">Medium</option>
                                                                <option value="large" >Large</option>
                                                                <option value="xlarge">X-Large</option>
                                                                <option value="xxlarge">XX-Large</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="description">Product Description:</label>
                                                                <textarea class="form-control" name="description" id="description" rows="3" placeholder="Product Description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <!-- Step 4 => Experience -->
                                                <h6><i class="step-icon font-medium-3 la la-file-image-o"></i> Product Photos</h6>
                                                <fieldset>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group" >
                                                                <input type="file" name="image[]" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>
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
    <script src="{{ URL::asset('app-assets/vendors/js/extensions/jquery.steps.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js') }}" type="text/javascript"></script>
   {{-- <script src="{{ URL::asset('app-assets/vendors/js/extensions/dropzone.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/ui/prism.min.js') }}" type="text/javascript"></script>--}}
    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->
    <script src="{{ URL::asset('app-assets/js/scripts/extensions/toastr.js') }}" type="text/javascript"></script>
   {{-- <script src="{{ URL::asset('app-assets/js/scripts/extensions/dropzone.js') }}" type="text/javascript"></script>--}}
    <script src="{{ URL::asset('app-assets/js/scripts/blades/add-product.js') }}" type="text/javascript"></script>
    <!-- END PAGE LEVEL JS-->


    </body>
</html>

