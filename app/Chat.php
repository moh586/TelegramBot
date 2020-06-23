<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Laravel\Facades\Telegram;

class Chat extends Model
{
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','operator_id','user_id','status', 'ended_at'
    ];

    public function messages()
    {
        return $this->belongsToMany('App\Message', 'chat_message', 'chat_id', 'message_id');
    }

    public function getMessages()
    {
        return $this->messages()->get();
    }

    public function operator()
    {
        return $this->belongsTo('App\User','operator_id');
    }

    public  function getOperator()
    {
        return $this->operator()->get()->first();
    }

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function getUser()
    {
        return $this->user()->get()->first();
    }

    public static function hasActiveChat($user_id)
    {
        return Chat::where('user_id',$user_id)->where('status','>',0)->count()>0?true:false;
    }

    public static function isBusy($seller_id)
    {
        return Chat::where('operator_id',$seller_id)->where('status','>',0)->count()>0?true:false;
    }

    public static function hasChatArchive($operator_id,$user_id)
    {
        return Chat::where('operator_id',$operator_id)->where('user_id',$user_id)->where('status',0)->count()>0?true:false;
    }

    public static function chatArchive($operator_id,$user_id)
    {
        return Chat::where('operator_id',$operator_id)->where('user_id',$user_id)->where('status',0)->latest()->get();
    }

    public static function startNewChat($operator_id,$user_id)
    {
        $customer=User::find($user_id);
        if(!Chat::isBusy($operator_id))
        {

            Chat::create([
                'operator_id'  => $operator_id,
                'user_id'       => $user_id,
                'status'        => 1
            ]);


            Telegram::sendMessage([
                'chat_id' =>  $operator_id,
                // 'text' => $text
                'text' => 'You are Connected to '.$customer->first_name." ".$customer->last_name." ".Emojify::text(':signal_strength:') ,
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);
            //
            Telegram::sendMessage([
                'chat_id' => $user_id,
                // 'text' => $text
                'text' => 'You are Connected to the Seller '. Emojify::text(':signal_strength:'),
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);
        }
        else
        {
            Chat::create([
                'operator_id'  => $operator_id,
                'user_id'       => $user_id,
                'status'        => 2
            ]);
            $response=Telegram::sendMessage([
                'chat_id' =>$user_id,
                // 'text' => $text
                'text' => 'The Seller is Busy right Now. You will be connect as soon as possible Please Wait... '.Emojify::text(':pray:').Emojify::text(':pray:'),
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);

            $customer->extra=$response->getMessageId();
            $customer->save();

        }
    }

    public static function resumeArchiveChat(Chat $chat)
    {
        $messages=$chat->messages()->latest()->take(10)->get();

        $messages=$messages->reverse();

        foreach ($messages as $message)
        {
            if($message->from==$chat->operator_id)
            {
                Message::sendDbMessage($message, $chat->user_id);
            }
            else{
                Message::sendDbMessage($message, $chat->operator_id);
            }
        }
       /* Telegram::sendMessage([
            'chat_id' => 110699273,
            // 'text' => $text
            'text' => json_encode( $messages->count())
        ]);*/

        $customer=User::find($chat->user_id);
        if(!Chat::isBusy($chat->operator_id))
        {

            $chat->status=1;
            $chat->save();


            Telegram::sendMessage([
                'chat_id' =>  $chat->operator_id,
                // 'text' => $text
                'text' => 'You are Connected to '.$customer->first_name." ".$customer->last_name." ".Emojify::text(':signal_strength:') ,
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);
            //
            Telegram::sendMessage([
                'chat_id' => $customer->id,
                // 'text' => $text
                'text' => 'You are Connected to the Seller '. Emojify::text(':signal_strength:'),
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);
        }
        else
        {
            $chat->status=2;
            $chat->save();

            $response=Telegram::sendMessage([
                'chat_id' => $customer->id,
                // 'text' => $text
                'text' => 'The Seller is Busy right Now. You will be connect as soon as possible Please Wait... '.Emojify::text(':pray:').Emojify::text(':pray:'),
                'reply_markup' => CustomKeyboard::ChatKeyboard()
            ]);

            $customer->extra=$response->getMessageId();
            $customer->save();

        }
    }
}
