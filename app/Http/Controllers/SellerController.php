<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class SellerController extends Controller
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

    public function showSellerList()
    {
        $users=User::getSellers();
        return view('layout/admin/sellers/sellerlist',compact('users'));
    }

    public function activeSeller(Request $request)
    {
        $seller=User::find($request->user_id);
        //$branch=Branch::find($request->bid)->get();
        $seller->activated=!$seller->activated;
        $seller->save();
        if($seller->activated)
            return response()->json(array('message'=> $seller->getFullName()." Activated","status"=>1,"statustext"=> 'Suspend'), 200);
        else
            return response()->json(array('message'=> $seller->getFullName()." Suspended","status"=>0,"statustext"=> 'Active'), 200);
    }
}
