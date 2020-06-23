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
<!-- BEGIN: Main Menu-->
<div class="main-menu menu-fixed menu-light menu-shadow menu-accordion expanded" data-scroll-to-active="true">
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a href="{{route('home')}}"><i class="la la-home"></i><span class="menu-title" data-i18n="Dashboard">Dashboard</span><span class="badge badge badge-info badge-pill float-right mr-2">5</span></a></li>
            <li class=" nav-item"><a href="{{route('seller_list')}}"><i class="la la-user-secret"></i><span class="menu-title" data-i18n="">Sellers</span><span class="badge badge badge-pill badge-danger float-right">1.0</span></a>
            </li>
            <li class=" navigation-header"><span>Customer</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Support"></i>
            </li>
            <li class=" nav-item"><a href="{{route('customer_list')}}"><i class="la la-users"></i><span class="menu-title" data-i18n="">Customers</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('chat_list')}}"><i class="la la-support"></i><span class="menu-title" data-i18n="">Chats</span></a>
            </li>
            <li class=" nav-item"><a href="https://pixinvent.com/modern-admin-clean-bootstrap-4-dashboard-html-template/documentation"><i class="la la-folder"></i><span class="menu-title" data-i18n="">Transactions</span></a>
            </li>
            <li class=" navigation-header"><span>Product</span><i class="la la-ellipsis-h ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Channel"></i>
            </li>
            <li class=" nav-item"><a href="{{route('product_list')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="">Products</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('product_new')}}"><i class="la la-plus-circle"></i><span class="menu-title" data-i18n="">Add Product</span></a>
            </li>
            <li class=" navigation-header"><span>Transaction</span><i class="la la-bank ft-minus" data-toggle="tooltip" data-placement="right" data-original-title="Channel"></i>
            </li>
            <li class=" nav-item"><a href="{{route('transaction_list')}}"><i class="la la-list"></i><span class="menu-title" data-i18n="">Transactions</span></a>
            </li>
            <li class=" nav-item"><a href="{{route('transaction_new')}}"><i class="la la-plus-circle"></i><span class="menu-title" data-i18n="">Add Transaction</span></a>
            </li>
        </ul>
    </div>
</div>
