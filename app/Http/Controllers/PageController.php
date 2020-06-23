<?php

namespace App\Http\Controllers;

use App\Chat;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Telegram\Bot\Laravel\Facades\Telegram;

class PageController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('index');
    }


    public function test()
    {
        //$admins=User::where('activated',true)->get();
        //dd(json_encode($admins));
        Chat::create([
            'operator_id'  =>  482979810,
            'user_id'       => 854393399,
            'status'        => 1
        ]);
    }
}
