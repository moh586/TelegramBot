<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 12/21/2018
 * Time: 6:23 AM
 */


?>
<?php
/**
 * Created by PhpStorm.
 * User: Madal
 * Date: 9/23/2018
 * Time: 9:56 PM
 */
?>
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="#">
                    <i class="la la-home"></i><span class="menu-title" data-i18n="">{{Auth::user()->getBusiness()->name}}</span>
                    <span class="badge badge badge-info badge-pill float-right mr-2">5</span></a>
            </li>
            <li class=" nav-item"><a  href="{{route('userslist')}}" >
                    <i class="la la-user"></i><span class="menu-title" data-i18n="nav.operators">{{__('message.operators')}}</span></a>
            </li>
            @if(!Session::has('branch'))
                @if($branch_count>0)
                    {{Session::put('branch',Auth::user()->branchs()->get()->first()->id)}}
                @endif
            @endif
            <li class=" nav-item"><a href="#"><i class="la la-bank"></i><span class="menu-title" data-i18n="">{{__('message.branchs')}}</span></a>
                    <ul class="menu-content">
                        <li><a class="menu-item" href="{{route('branchlist')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.branchs_manage')}}</a></li>
                        @foreach($branchs as $branch)
                                <li><a class="menu-item" href="{{route('branch.select',['id'=>$branch->id])}}" data-i18n="nav.starter_kit.2_columns">{{$branch->name}}</a></li>
                        @endforeach
                    </ul>
            </li>


            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.customers')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('customerslist')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.customers_list')}}</a></li>
                    <li><a class="menu-item" href="{{route('customer.create')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.customer_register')}}</a></li>
                    <li><a class="menu-item" href="{{route('customer.search')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.customer_search')}}</a></li>
                    {{--<li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.customer_delete')}}</a></li>--}}
                    {{--<li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.customer_info')}}</a></li>--}}
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="{{route('customlist.list')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="">{{__('message.customers_conditional')}}</span></a>

            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-newspaper-o"></i><span class="menu-title" data-i18n="">{{__('message.operation')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="{{route('customer.transaction.new')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.operation_record_score')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.operation_edit_score')}}</a></li>
                    <li><a class="menu-item" href="{{route('customer.gift.new')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.operation_record_reward')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.operation_edit_reward')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item  {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.notices')}}</span></a>
                <ul class="menu-content">
                    <li><a class="nav-item" href="#" >{{__('message.notices_sms')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_sms_manual')}}</a></li>
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_sms_setting')}}</a></li>
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_sms_charge')}}</a></li>
                        </ul>
                    </li>

                    <li><a class="nav-item" href="#" >{{__('message.notices_email')}}</a>
                        <ul class="menu-content">
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_email_manual')}}</a></li>
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_email_setting')}}</a></li>
                            <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.notices_email_charge')}}</a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.reports')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.report_score')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.report_rating')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.report_introduce_other')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.application')}}</span></a>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.loyalty')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.loyalty_scoring')}}</a></li>
                    <li><a class="menu-item" href="{{route('level.list')}}" data-i18n="nav.starter_kit.2_columns">{{__('message.loyalty_rating')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.loyalty_introduce_other')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.loyalty_score_rule')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.loyalty_reward_rule')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.sync')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.sync_online_store')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.sync_accounting_app')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.sync_pos')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.sync_api')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.agency')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_account_info')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_edit_tariff')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_brand_setting')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_customers_report')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_bills')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.agency_support')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.support_learn')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.support_learn_send_ticket')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.support_learn_sended_ticket')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.support_learn_learning')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.financial')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.financial_bills')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.financial_invoice')}}</a></li>
                </ul>
            </li>
            <li class=" nav-item {{$disabled}}"><a href="#"><i class="la la-users"></i><span class="menu-title" data-i18n="">{{__('message.setting')}}</span></a>
                <ul class="menu-content">
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.setting_user_managment')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.setting_account_info')}}</a></li>
                    <li><a class="menu-item" href="#" data-i18n="nav.starter_kit.2_columns">{{__('message.setting_plan_promote')}}</a></li>
                </ul>
            </li>
        </ul>
    </div>
</div>
