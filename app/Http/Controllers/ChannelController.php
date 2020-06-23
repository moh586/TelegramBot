<?php

namespace App\Http\Controllers;

use App\File;
use App\Photo;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Laravel\Facades\Telegram;

class ChannelController extends Controller
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


    public  function  sendSimpleMessage()
    {
        File::getMediaPath('AgACAgQAAxkBAAIH6V7R59NFgIgxMsDdqwdRd3IZHBBaAAIQsTEbyTeQUtqfpQw1c04NYXY8JF0AAwEAAwIAA20AA1w6AQABGQQ');
        /*$users=User::all();
        Telegram::sendMessage([
            'chat_id' => 110699273,
            // 'text' => $text
            'text' =>json_encode($users->count())
        ]);
        foreach ($users as $user)
        {
            Photo::getUserProfilePhotoPath($user);
        }*/
        return view('layout/channel/sendsimplemessage');
    }


    public function sendMessageByAjax(Request $request)
    {

        if ($request->ajax()) {
            try{
                $message=Telegram::sendMessage([
                    'chat_id' => -1001245388771,
                    // 'text' => $text
                    'text' =>"Wellcome to ReviewersChannel Bot.This bot connects you to sellers with many attractive products.به بات کانال ریویورز خوش امدید این بات شما رو به فروشنده ها با کالاهای جذاب وصل میکنه \nFor Begin Click on".Emojify::text(':point_down:')."Start".Emojify::text(':point_down:')
                ]);
                /*error_log($message->getMessageId());
                error_log($message->getFrom()->getId());
                error_log($message->getForwardFrom()->getId());
                error_log($message->getReplyToMessage()->getMessageId());
                error_log($message->getText());
                error_log($message->getAudio()->getFileId());
                error_log($message->getDocument()->getFileId() );
                error_log($message->getSticker()->getFileId());
                error_log($message->getVoice()->getFileId());
                error_log($message->getVideo()->getFileId());
                error_log($message->getPhoto()->getFileId());
                error_log($message->getCaption());
                error_log($message->getContact()->getUserId());
                error_log($message->entities);*/
                return response()->json(['status' => 1, 'message' => 'Message was Sent']);
            }
            catch (\Throwable $e) {
                error_log(json_encode($e));
                return response()->json(['status' => 0, 'message' => 'Fail to Send.Try Again']);
            }
            /*$business_id = Session::get('business');
            $branch = (Auth::user()->isAdmin() || Auth::user()->isModerator() ? 0 : Auth::user()->getBranchs()->first()->id);
            $userid = Auth::user()->id;
            //
            $customer = Customer::where('id', $request->customer)->where('business_id', $business_id);
            try {
                if ($customer->count() == 1) {
                    $customer = $customer->first();
                    //validate score
                    if (!$request->filled('gift') || !is_numeric($request->gift))
                        return response()->json(['status' => 0, 'message' => Lang::get('message.operation.add.reward.notFound')]);

                    $gift = Gift::where('id', $request->gift);
                    if ($gift->count() != 1) {
                        return response()->json(['status' => 0, 'message' => Lang::get('message.operation.add.reward.notFound')]);
                    }
                    $gift = $gift->first();
                    if ($gift->score > $customer->score) {
                        return response()->json(['status' => 0, 'message' => Lang::get('message.operation.add.reward.lessScore')]);
                    }


                    $transaction = Transaction::create([
                        'score' => $gift->score * -1,
                        'user_id' => $userid,
                        'customer_id' => $request->customer,
                        'branch_id' => $branch,
                        'token' => str_random(64),
                        'description' => $request->description . " " . $gift->title,
                    ]);

                    $customer->score -= $gift->score;
                    $customer->save();
                    $customer->gifts()->attach($gift->id, ['branch_id' => $branch, 'description' => $request->description]);
                    $customer->save();


                    return response()->json(['status' => 1, 'message' => Lang::get('message.operation.add.reward.SuccessfullyAdded')]);
                } else
                    return response()->json(['status' => 0, 'message' => Lang::get('message.nouser')]);

            } catch (\Throwable $e) {
                error_log(json_encode($e));
                return response()->json(['status' => 0, 'message' => Lang::get('message.operation.add.transaction.FailAdded')]);
            }*/
        }
    }



}
