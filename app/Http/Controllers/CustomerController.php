<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showCustomerList()
    {
        $customers=User::getCustomers();
        return view('layout/admin/customers/customerlist',compact('customers'));
    }

    public function activeCustomer(Request $request)
    {
        $customer=User::find($request->user_id);
        //$branch=Branch::find($request->bid)->get();
        $customer->activated=!$customer->activated;
        $customer->save();
        if($customer->activated)
            return response()->json(array('message'=> $customer->getFullName()." Activated","status"=>1,"statustext"=> 'Suspend'), 200);
        else
            return response()->json(array('message'=> $customer->getFullName()." Suspended","status"=>0,"statustext"=> 'Active'), 200);
    }


    public function customerTypehead($filter)
    {


        $role=Role::where('name','=','customer')->first();

        $customers=User::where('activated', '=',1)->where('role_id',$role->id)
            ->where(function ($query) use ($filter) {
                $query->where('first_name','like',"%".$filter."%")
                    ->orWhere('last_name','like',"%".$filter."%")
                    ->orWhere('username','like',"%".$filter."%");
            });


        $customers=$customers->take(10)->get(['first_name','last_name','username','avatar','id']);
        return response()->json($customers);
    }
}
