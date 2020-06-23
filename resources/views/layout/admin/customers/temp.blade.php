@extends('layout.mainlayout')

@section('template_title')
    {{__('message.page.createcustomer')}}
@endsection


@section('CustomCSS')

    <!-- BEGIN VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/vendors.css') }}">




    <!-- END VENDOR CSS-->

    <!-- BEGIN MODERN CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/app.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/custom-rtl.css') }}">
    <!-- END MODERN CSS-->

    <!-- BEGIN Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/menu/menu-types/vertical-menu-modern.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/core/colors/palette-gradient.css') }}">

    <!-- END Page Level CSS-->

    <!-- BEGIN Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('assets/css/style-rtl.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ URL::asset('app-assets/css-rtl/plugins/forms/extended/form-extended.css') }}">
    <!-- END Custom CSS-->

    @endsection

@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
                    <h2 class="content-header-title mb-0 d-inline-block">{{__('message.page.createcustomer')}}</h2>

                </div>

            </div>

            <div class="content-body">
                <!-- Basic form layout section start -->
                <section class="typeahead" id="typeahead">


                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Typeahead</h4>
                                    <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-12">
                                                <fieldset>
                                                    <h5>Basic Typeahead</h5>
                                                    <p class="text-muted">When initializing a <code>typeahead</code>, you pass the
                                                        plugin method one or more datasets. The source of a dataset
                                                        is responsible for computing a set of suggestions for
                                                        a given query.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control typeahead-basic" id="the-basic" placeholder="Start Typing.."
                                                        />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Prefetch Data</h5>
                                                    <p class="text-muted">Prefetched data is fetched and processed on initialization.
                                                        If the browser supports local storage, the processed
                                                        data will be cached there to prevent additional network
                                                        requests on subsequent page loads.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control typeahead-prefetch" id="the-prefetch" placeholder="Countries"
                                                        />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Remote Data</h5>
                                                    <p class="text-muted">Remote data is only used when the data provided by local
                                                        and prefetch is insufficient. In order to prevent an
                                                        obscene number of requests being made to the remote endpoint,
                                                        requests are rate-limited.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control typeahead-remote" id="the-remote" placeholder="Oscar winners for Best Picture"
                                                        />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Custom Templates</h5>
                                                    <p class="text-muted">Custom templates give you full control over how suggestions
                                                        get rendered making it easy to customize the look and
                                                        feel of your typeahead. This requires <code>Handlebars.js</code>                            extension for compilation.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control custom-template" id="custom-template" placeholder="Oscar winners for Best Picture"
                                                        />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Default Suggestions</h5>
                                                    <p class="text-muted">Default suggestions can be shown for empty queries by setting
                                                        the <code>minLength</code> option to 0 and having the
                                                        source return suggestions for empty queries.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control default-suggestions" id="default-suggestions"
                                                               placeholder="NFL Teams" />
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <div class="col-xl-6 col-lg-12">
                                                <fieldset>
                                                    <h5>Bloodhound Engine</h5>
                                                    <p class="text-muted">For more advanced use cases, rather than implementing the
                                                        source for your dataset yourself, you can take advantage
                                                        of <code>Bloodhound</code>, the <code>typeahead.js</code>                            suggestion engine.
                                                        <br>Bloodhound is stack, flexible, and offers advanced functionalities
                                                        such as prefetching, intelligent caching, fast lookups,
                                                        and backfilling with remote data.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control typeahead-bloodhound" id="the-bloodhound"
                                                               placeholder="Start Typing.." />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Multiple Datasets</h5>
                                                    <p class="text-muted">Multiple datasets give you visually separated sets of data
                                                        inside Dropdown menu with <code>saperate titles</code>,
                                                        managed in <code>templates</code> option. This looks
                                                        like a <code>&lt;optgroup&gt;</code> titles in selects.</p>
                                                    <div class="form-group">
                                                        <input type="text" class="form-control multiple-datasets" id="multiple-datasets"
                                                               placeholder="NBA and NHL teams" />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>Scrollable Dropdown Menu</h5>
                                                    <p class="text-muted">To change the height of your dropdown menu, just wrap your
                                                        input in some <code>div</code> with <code>custom css</code>                            styles and change necessary css properties or change
                                                        it in css directly.</p>
                                                    <div class="form-group scrollable-dropdown">
                                                        <input type="text" class="form-control scrollable-dropdown-menu" id="scrollable-dropdown-menu"
                                                               placeholder="Countries" />
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <h5>RTL Support</h5>
                                                    <p class="text-muted">Typeahead supports <code>RTL</code> also. Wrap your input
                                                        in any div with <code>text-align: right;</code> property
                                                        and add dir="rtl" to your input, now your dropdown menu
                                                        is right aligned.</p>
                                                    <div class="form-group rtl-typeahead">
                                                        <input type="text" class="form-control rtl-support" dir="rtl" id="rtl-support" placeholder="States"
                                                        />
                                                    </div>
                                                </fieldset>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>


        </div>
    </div>

@endsection


@section('CustomJS')

    <!-- BEGIN VENDOR JS-->
    <script src="{{URL::asset('app-assets/vendors/js/vendors.min.js')}}" type="text/javascript"></script>
    <!-- BEGIN VENDOR JS-->

    <!-- BEGIN PAGE VENDOR JS-->
    {{--<script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>--}}
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/typeahead/handlebars.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/formatter/formatter.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/extended/card/jquery.card.js') }}" type="text/javascript"></script>

    <!-- END PAGE VENDOR JS-->

    <!-- BEGIN MODERN JS-->
    <script src="{{ URL::asset('app-assets/js/core/app-menu.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/core/app.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/js/scripts/customizer.js') }}" type="text/javascript"></script>
    <!-- END MODERN JS-->

    <!-- BEGIN PAGE LEVEL JS-->


    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/extended/form-typeahead.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/extended/form-inputmask.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/extended/form-formatter.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/extended/form-maxlength.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/extended/form-card.js')}}" ></script>
    {{-- <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/blades/createcustomer.js')}}" ></script>--}}
    <!-- END PAGE LEVEL JS-->

@endsection


{{--@section('customfooterscript')

   --}}{{-- <script type="text/javascript" src="{{ URL::asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}" ></script>
    <script type="text/javascript" src="{{ URL::asset('app-assets/js/scripts/forms/select/form-select2.js')}}" ></script>--}}{{--



    <script src="{{ URL::asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/validation/jqBootstrapValidation.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ URL::asset('app-assets/vendors/js/forms/toggle/bootstrap-switch.min.js') }}" type="text/javascript"></script>

    <script src="{{ URL::asset('app-assets/js/scripts/forms/validation/form-validation.js') }}" type="text/javascript"></script>



@endsection--}}
