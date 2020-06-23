<?php

namespace App\Http\Controllers;


use App\Product;
use App\ProductColor;
use App\ProductPhoto;
use App\ProductSize;
use App\Transaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
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



    public function listTransaction()
    {
        $transactions=Transaction::all()->sortByDesc('created_at');
        return view('layout/ui/transaction/transactionlist',compact('transactions'));
    }

    public function addTransaction()
    {
        $sellers=User::getSellers();
        return view('layout/ui/transaction/addtransaction',compact('sellers'));
    }

    public function storeTransaction(Request $request)
    {

        try {


            $transaction = Transaction::create([
                'customer_id' => $request->input('customer_id'),
                'agent_id' => Auth::user()->id,
                'product_id' => $request->input('product_id'),
                'extra' => $request->input('extra'),
                'quantity' => $request->input('quantity'),
            ]);

            return redirect(route('transaction_list'))->with('success', 'Transaction Added Successfully');
        }
        catch (\Throwable $e)
        {
            return Redirect::back()->withErrors("Operation Failed.Try Again!");
        }
    }

}
