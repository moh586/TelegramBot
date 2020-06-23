<?php

namespace App\Http\Controllers;

use App\Chat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

class ChatController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function showChatList()
    {
        Log::info('hi');
        //$customers=User::getCustomers();
        $chats=Chat::all()->sortByDesc('created_at');
        //error_log(json_encode($chats));
        $chat=Chat::find(56);
        $messages=$chat->getMessages();
        //error_log($messages->count());
        return view('layout/ui/chats/chats',compact('chats','messages','chat'));
    }


    public function loadMessages(Request $request)
    {


        if ($request->ajax()) {
            try {
                $chat=Chat::find($request->chat_id);
                $messages=$chat->getMessages();
                //error_log(Response::json(View::make('layout.owner.customers.customerrows', ['customers' => $customers, 'levels' => $levels])->render()));
                $v1=View::make('layout.ui.chats.chatmessages', ['messages' => $messages, 'chat' => $chat])->render();
                Log::info($v1);
                //$v2=View::make('layout.owner.customers.customerinfo',['customers' => $customers])->render();
                return response()->json(['v1'=>$v1,'status'=>1]);
            } catch (\Throwable $e) {
                return response()->json(['status'=>0,'message'=>$e->getMessage()." Please Try again!"]);
            }
        }
    }
}
