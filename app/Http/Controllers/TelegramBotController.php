<?php

namespace App\Http\Controllers;

use App\Chat;
use App\CustomKeyboard;
use App\Message;
use App\Role;
use App\Seller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mockery\Exception;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;


class TelegramBotController extends Controller
{
    //
    public function updatedActivity()
    {

        //$activity = Telegram::getWebhookUpdates();
       // dd(json_encode( $activity));

        $message=Telegram::sendMessage([
                'chat_id' => 110699273,//env('TELEGRAM_CHANNEL_ID', ''),

            'text' =>"Wellcome to ReviewersChannel Bot.This bot connects you to sellers with many attractive products.به بات کانال ریویورز خوش امدید این بات شما رو به فروشنده ها با کالاهای جذاب وصل میکنه For Begin Click on".Emojify::text(':point_down:')."Start".Emojify::text(':point_down:')
            ]);
            //
       // dd($message->getMessageId());
       // dd($message->getFrom()->getId());


    }


    public function bot()
    {
        $update = Telegram::commandsHandler(true);
        $updates = Telegram::getWebhookUpdates();
        //
       // return true;

        Telegram::sendMessage([
            'chat_id' => 110699273,
            // 'text' => $text
            'text' => json_encode( $updates)
        ]);

        $updateType = $updates->detectType();

        $update_id=$updates->getUpdateId();
        $message=$updates->getMessage();
        $chat=$message->getChat();
        $text=$message->getText();
        $sender=$message->getFrom();


        //
        $chat_id = $updates->getMessage()->getChat()->getId();
        $firstname = $updates->getMessage()->getChat()->getFirstName();
        $lasttname = $updates->getMessage()->getChat()->getLastName();
        $Username = $updates->getMessage()->getChat()->getUsername();

        //**************************call back query***************************
        if ($updates->isType('callback_query')) {

            $query = $updates->getCallbackQuery();
            $sender=$query->getFrom();
            $data  = $query->getData();
            //check user is blocked
            $customer=User::find($sender->getId());
            if(!is_null($customer)&&!$customer->activated)
            {
                $customer->sendMessage('Sorry.You are Block.Please Contact Admin'.Emojify::text(':pray:').Emojify::text(':pray:'));
                return true;
            }
            $params=explode("&",$data);

            //******************
            if($params[0]=="approve_seller")
            {
                $sellerRole = Role::whereName('seller')->first();
                $seller=User::find($params[1]);
                $seller->role_id=$sellerRole->id;
                $seller->save();

                $adminRole = Role::whereName('admin')->first();
                $admins=User::where('role_id',$adminRole->id)->where('activated',true)->get();
                $verify_message= $seller->first_name." ".$seller->last_name."(".$seller->username.") Approved as a Seller";
                foreach ($admins as $user)
                {
                    $response = Telegram::sendMessage([
                        'chat_id' => $user->id,
                        'text' =>$verify_message
                    ]);
                }

                //
                Message::deleteMessageByExtra($seller);
               /* Telegram::deleteMessage([
                    'chat_id'=>$seller->id,
                    'message_id'=>$seller->extra,
                ]);*/
                //
                Telegram::sendMessage([
                    'chat_id' => $seller->id,
                    'text' =>'Congratulation.You are Approved as a Seller. '.Emojify::text(':tada:').Emojify::text(':tada:'),
                    'reply_markup' => CustomKeyboard::SellerDefaultKeyboard()

                ]);
                return true;
            }


            else if($params[0]=="seller")
            {
                //delete inline KeyBoard
                Message::deleteMessageByExtra($customer);
              /*  Telegram::deleteMessage([
                    'chat_id'=>$customer->id,
                    'message_id'=>$customer->extra,
                ]);*/


                if(Chat::hasChatArchive($params[1],$customer->id))
                {
                    $response = Telegram::sendMessage([
                        'chat_id' => $customer->id,
                        'text' =>Emojify::text(':point_right:'). 'Please Select   '.Emojify::text(':point_left:'),
                        'reply_markup' => CustomKeyboard::chatNewResumeinlineKeyboard($params[1],$customer->id)
                    ]);
                    //
                    $customer->extra=$response->getMessageId();
                    $customer->save();
                }
                else
                {
                    Chat::startNewChat($params[1],$customer->id);
                }

            }
            else if($params[0]=="new_chat")
            {
                Message::deleteMessageByExtra($customer);
                Chat::startNewChat($params[1],$sender->getId());
            }
            else if($params[0]=="resume_chat")
            {
                Message::deleteMessageByExtra($customer);
                $archive=Chat::chatArchive($params[1],$sender->getId());
                $response = Telegram::sendMessage([
                    'chat_id' => $customer->id,
                    'text' =>Emojify::text(':point_right:'). 'Please Select a Chat   '.Emojify::text(':point_left:'),
                    'reply_markup' => CustomKeyboard::chatArchiveinlineKeyboard($archive)
                ]);
                //
                $customer->extra=$response->getMessageId();
                $customer->save();
                //
            }
            else if($params[0]=="chat_archive")
            {
                Message::deleteMessageByExtra($customer);
                $chat=Chat::find($params[1]);

               Chat::resumeArchiveChat($chat);
                //
            }
            return true;
        }

        else if($updates->isType('message')) {
            $message=$updates->getMessage();
            $sender=$message->getFrom();
            $customer=User::find($sender->getId());
            if(!is_null($customer)&&!$customer->activated)
            {
                $customer->sendMessage('Sorry.You are Block.Please Contact Admin'.Emojify::text(':pray:').Emojify::text(':pray:'));
                return true;
            }

            if(CustomKeyboard::checkButtonPress($message))
                return true;


            $chat=Chat::where('operator_id',$sender->getId())->where('status',1);
            if($chat->count()==1)
            {
                $chat=$chat->first();
                $chat->messages()->attach($message->getMessageId());
                Message::sendMessageInChat($message,$chat->user_id);
                return true;
            }
            $chat=Chat::where('user_id',$sender->getId())->where('status',1);
            if($chat->count()==1)
            {
                $chat=$chat->first();
                $chat->messages()->attach($message->getMessageId());
                Message::sendMessageInChat($message,$chat->operator_id);
                return true;
            }
            return true;
        }
        //



        /*$send_id=110699273;
        if($message->getFrom()->getId()==110699273)
            $send_id=482979810;



        $response = Telegram::sendMessage([
            'chat_id' => $send_id,
            // 'text' => $text
            'text' => json_encode($updates)
        ]);

        $messageId = $response->getMessageId();
        return $messageId;
        */


    }



}
