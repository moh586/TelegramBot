<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class CustomKeyboard extends Model
{
    /**
     * @return Keyboard as  a default keyboard for customers
     */
    public  static  function  DefaultKeyboard()
    {
        $keyboard =Keyboard::make()
            ->row(Keyboard::Button(['text' => 'Start Chat  '.Emojify::text(':speech_balloon:')]))
            ->row(Keyboard::Button(['text' => 'Search Product (temp)  '.Emojify::text(':mag:')]))
            ->setResizeKeyboard(true);
        return $keyboard;
    }


    /**
     * @return Keyboard ,should be shown through Chat
     */
    public  static  function  ChatKeyboard()
    {
        $keyboard =Keyboard::make()
            ->row(Keyboard::Button(['text' => 'End Chat  '.Emojify::text(':end:')]))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);
        return $keyboard;
    }
    //
    public  static  function  SellerDefaultKeyboard()
    {
        $keyboard =Keyboard::make()
            ->row(Keyboard::Button(['text' => 'Add Product  '.Emojify::text(':speech_balloon:')]))
            ->row(Keyboard::Button(['text' => 'Edit Product  '.Emojify::text(':mag:')]))
            ->row(Keyboard::Button(['text' => 'Delete Product  '.Emojify::text(':mag:')]))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);
        return $keyboard;
    }

    public  static  function  AdminDefaultKeyboard()
    {
        $keyboard =Keyboard::make()
            ->row(Keyboard::Button(['text' => 'Add Product  '.Emojify::text(':speech_balloon:')]))
            ->row(Keyboard::Button(['text' => 'Edit Product  '.Emojify::text(':mag:')]))
            ->row(Keyboard::Button(['text' => 'Delete Product  '.Emojify::text(':mag:')]))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);
        return $keyboard;
    }

    public static function chatNewResumeinlineKeyboard($operator_id,$user_id)
    {
        $reply_markup=Keyboard::make()
            ->inline()
            ->row(Keyboard::inlineButton(['text'=>'New Chat '.Emojify::text(':new:'), 'callback_data' => "new_chat&".$operator_id."&".$user_id]))
            ->row(Keyboard::inlineButton(['text'=>'Resume Chat '.Emojify::text(':fast_forward:'), 'callback_data' => "resume_chat&".$operator_id."&".$user_id]))
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);
       //
        return $reply_markup;
    }

    public static function chatArchiveinlineKeyboard($archive)
    {
        $reply_markup=Keyboard::make()
            //Keyboard::button(['text' => '1', 'callback_data' => "seller1"])
            ->inline()
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);


        foreach ($archive as $chat)
        {
            $reply_markup->row(Keyboard::inlineButton(['text' => Emojify::text(':speech_balloon:')." ".Carbon::parse($chat->created_at)->format('d/m/Y H:i:s'),
                'callback_data' => "chat_archive&".$chat->id."&".$chat->operator_id."&".$chat->user_id]));
        }
        return $reply_markup;
    }

    public static function checkButtonPress(\Telegram\Bot\Objects\Message $message)
    {

        $text=$message->text;
        if($text=='Start Chat  '.Emojify::text(':speech_balloon:'))
        {
            if(!User::find($message->getFrom()->getId())->isCustomer())
            {
                Telegram::sendMessage([
                    'chat_id' => $message->getFrom()->getId(),
                    'text' => 'Chat should be started By user '.Emojify::text(':pray:'),
                ]);
                return true;
            }
            //Sart Chat

            if(Chat::hasActiveChat($message->getFrom()->getId()))
            {

               /* $reply_markup=Keyboard::make()
                    ->row(
                        [Keyboard::button(['text' => 'Yes', 'callback_data' => "endChat"]),
                            Keyboard::button(['text' => 'No', 'callback_data' => "resumChat"])  ]
                    )->setOneTimeKeyboard(true)->setResizeKeyboard(true);*/
                $response = Telegram::sendMessage([
                    'chat_id' => $message->getFrom()->getId(),
                    'text' => 'You are in another Chat.Please End that '.Emojify::text(':pray:'),
                ]);

                return true;
            }



            $sellers=User::getSellers();

            $reply_markup=Keyboard::make()
                //Keyboard::button(['text' => '1', 'callback_data' => "seller1"])
                ->inline()
                ->setOneTimeKeyboard(true)
                ->setResizeKeyboard(true);
            $i=0;

            foreach ($sellers as $seller)
            {
                $reply_markup->row(Keyboard::inlineButton(['text' => (++$i)." ".$seller->first_name, 'callback_data' => "seller&".$seller->id]));
            }



            $response = Telegram::sendMessage([
                'chat_id' => $message->getFrom()->getId(),
                'text' => 'Please Select Seller  '.Emojify::text(':speaking_head:'),
                'reply_markup' => $reply_markup
            ]);
            //
            $user=User::find($message->getFrom()->getId());
            $user->extra=$response->getMessageId();
            $user->save();


            return true;
        }

        else if($text=='End Chat  '.Emojify::text(':end:'))
        {
            $chat=Chat::where('status',1)->where(function ($query) use ($message) {
                $query->where('operator_id',$message->getFrom()->getId())->orWhere('user_id',$message->getFrom()->getId());
            });
            if($chat->count()==1)
            {
                $chat=$chat->first();
                $chat->status=0;
                $chat->ended_at=Carbon::now();
                $chat->save();
                //
                Telegram::sendMessage([
                    'chat_id' =>  $chat->operator_id,
                    // 'text' => $text
                    'text' => 'the Chat ended  '.Emojify::text(':wave:'),
                    'reply_markup' => CustomKeyboard::SellerDefaultKeyboard()
                ]);
                //
                Telegram::sendMessage([
                    'chat_id' => $chat->user_id,
                    // 'text' => $text
                    'text' => 'the Chat ended  '.Emojify::text(':wave:'),
                    'reply_markup' => CustomKeyboard::DefaultKeyboard()
                ]);
                //
                $pending_chat=Chat::where('status',2)->where('operator_id',$chat->operator_id)->oldest();
                if($pending_chat->count()>0)
                {
                    $pending_chat=$pending_chat->first();
                    $pending_chat->status=1;
                    $pending_chat->save();
                    $user=User::find($pending_chat->user_id);
                    //
                    Message::deleteMessageByExtra($user);
                  /*  Telegram::deleteMessage([
                        'chat_id'=>$user->id,
                        'message_id'=>$user->extra,
                    ]);*/
                    //
                    Telegram::sendMessage([
                        'chat_id' =>  $pending_chat->operator_id,
                        // 'text' => $text
                        'text' => 'You are Connected to '.$user->first_name." ".$user->last_name ."  ".Emojify::text(':blush:').Emojify::text(':blush:'),
                        'reply_markup' => CustomKeyboard::ChatKeyboard()
                    ]);
                    //
                    Telegram::sendMessage([
                        'chat_id' => $pending_chat->user_id,
                        // 'text' => $text
                        'text' => 'You are Connected to the Seller  '.Emojify::text(':blush:').Emojify::text(':blush:'),
                        'reply_markup' => CustomKeyboard::ChatKeyboard()
                    ]);

                }
                return true;
            }
            else {

                $reserve_chat = Chat::where('status', 2)->where('user_id', $message->getFrom()->getId());
                if ($reserve_chat->count() > 0) {
                    $reserve_chat = $reserve_chat->first();
                    $reserve_chat->status = 0;
                    $chat->ended_at=Carbon::now();
                    $reserve_chat->save();

                    $user = User::find($message->getFrom()->getId());

                    Telegram::deleteMessage([
                        'chat_id' => $user->id,
                        'message_id' => $user->extra,
                    ]);

                    Telegram::sendMessage([
                        'chat_id' => $reserve_chat->user_id,
                        // 'text' => $text
                        'text' => 'the Chat ended  ' . Emojify::text(':wave:'),
                        'reply_markup' => CustomKeyboard::DefaultKeyboard()
                    ]);
                    return true;
                }
            }

            return true;
        }
        else
        {
            return false;
        }

    }
}
