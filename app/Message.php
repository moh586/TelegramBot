<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Telegram\Bot\Laravel\Facades\Telegram;
use Telegram\Bot\Objects\PhotoSize;

class Message extends Model
{
    //

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','from','forward_from','reply_message_id', 'text','audio_id','document_id','sticker_id','voice_id',
        'video_id','photo_id','caption','location_id','contact_id','sent_id','entities'
    ];

    public function chats()
    {
        return $this->belongsToMany('App\Chat');
    }

    public function from()
    {
        return $this->belongsTo('App\User','from');
    }

    public function getFrom()
    {
        return $this->from()->get()->first();
    }



    public static function storeMessage(\Telegram\Bot\Objects\Message $message,$sent_id=null)
    {

       /* Telegram::sendMessage([
            'chat_id' => 110699273,
            // 'text' => $text
            //'text' =>json_encode($message->has('forwardFrom')) ."@". json_encode($message->has('replyToMessage'))
            'text' => $sent_id
        ]);*/

        $new_message=Message::create([
            'id'                =>$message->getMessageId(),
            'from'              =>$message->getFrom()->getId(),
            'forward_from'      =>$message->getForwardFrom()==null?null:$message->getForwardFrom()->getId(),
            'reply_message_id'  =>$message->getReplyToMessage()==null?null:$message->getReplyToMessage()->getMessageId(),
            'text'              =>$message->getText(),
            'audio_id'          =>$message->getAudio()==null?null:$message->getAudio()->getFileId(),
            'document_id'       =>$message->getDocument()==null?null:$message->getDocument()->getFileId() ,
            'sticker_id'        =>$message->getSticker()==null?null:$message->getSticker()->getFileId(),
            'voice_id'          =>$message->getVoice()==null?null:$message->getVoice()->getFileId(),
            'video_id'          =>$message->getVideo()==null?null:$message->getVideo()->getFileId(),
            //'photo_id'          =>$message->getPhoto()==null?null:$photo_id ,
            'photo_id'          =>$message->has('photo')?$message->getPhoto()[0]['file_id'] :null,
            'caption'           =>$message->getCaption()==null?null:$message->getCaption(),
            'contact_id'        =>$message->getContact()==null?null:$message->getContact()->getUserId(),
            'sent_id'           =>$sent_id,
            'entities'          =>$message->entities==null?null:$message->entities,
        ]);

    }


    /**
     * Delete a Sent Message
     * @param $chat_id  chat id that message was send
     * @param $messsage_id  id of message
     */
    public static function deleteMessageById($chat_id,$messsage_id)
    {
        Telegram::deleteMessage([
            'chat_id'=>$chat_id,
            'message_id'=>$messsage_id,
        ]);
    }

    /**
     * Delete a Message was sent for a user
     * @param User $customer user who message sent for him
     */
    public static function  deleteMessageByExtra(User $customer)
    {
        Telegram::deleteMessage([
            'chat_id'=>$customer->id,
            'message_id'=>$customer->extra,
        ]);
    }


    /**
     * @param Message $message message that should be sended from db
     * @param $recive_id
     */
    public static function sendDbMessage(Message $message,$recive_id)
    {
        $response='';
        //



        if($message->hasPhoto())
        {
            $response=Telegram::sendPhoto([
                'chat_id' =>  $recive_id,
                'photo' => $message->photo_id,
                'caption' => $message->caption,

            ]);
        }
        else if($message->hasDocument())
        {
            $response=Telegram::sendDocument([
                'chat_id' =>  $recive_id,
                'document' => $message->document_id,
                'caption' => $message->caption,

            ]);
        }
        else if($message->hasVideo())
        {
            $response=Telegram::sendVideo([
                'chat_id' =>  $recive_id,
                'video' => $message->video_id,
                'caption' => $message->caption,

            ]);
        }
        else if($message->hasSticker())
        {
            $response=Telegram::sendSticker([
                'chat_id' =>  $recive_id,
                'sticker' => $message->sticker_id,
            ]);
        }
        else if($message->hasVoice())
        {

            $response=Telegram::sendVoice([
                'chat_id' =>  $recive_id,
                'voice' => $message->voice_id,
                'caption' => $message->caption,
            ]);
        }
        else if($message->hasAudio())
        {
            $response=Telegram::sendAudio([
                'chat_id' =>  $recive_id,
                'audio' => $message->audio_id,
                'caption' => $message->caption,
            ]);
        }
        else {
            $response=Telegram::sendMessage([
                'chat_id' => $recive_id,
                // 'text' => $text
                'text' => $message->text,
            ]);
        }
        $message->sent_id=$response->getMessageId();
        $message->save();
    }

    /**
     * @param \Telegram\Bot\Objects\Message $message message that shiuld be sended from telegram message
     * @param $recive_id
     */
    public static function sendMessageInChat(\Telegram\Bot\Objects\Message $message,$recive_id)
    {
        $response='';
        //
        $reply_message_id=0;
        if($message->has('reply_to_message')) {
            if($message->getFrom()->getId()==$message->getReplyToMessage()->getFrom()->getId())
                $reply_message_id=Message::where('id', $message->getReplyToMessage()->getMessageId())->first()->sent_id;
            else
                $reply_message_id=Message::where('sent_id', $message->getReplyToMessage()->getMessageId())->first()->id;

        }
        /*if($message->has('forward_from'))
        {

        }*/
        if($message->has('photo'))
        {
            $response=Telegram::sendPhoto([
                'chat_id' =>  $recive_id,
                'photo' => $message->getPhoto()[0]['file_id'],
                'caption' => $message->getCaption(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else if($message->has('document'))
        {
            $response=Telegram::sendDocument([
                'chat_id' =>  $recive_id,
                'document' => $message->getDocument()->getFileId(),
                'caption' => $message->getCaption(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else if($message->has('video'))
        {
            $response=Telegram::sendVideo([
                'chat_id' =>  $recive_id,
                'video' => $message->getVideo()->getFileId(),
                'caption' => $message->getCaption(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else if($message->has('sticker'))
        {
            $response=Telegram::sendSticker([
                'chat_id' =>  $recive_id,
                'sticker' => $message->getSticker()->getFileId(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else if($message->has('voice'))
        {

            $response=Telegram::sendVoice([
                'chat_id' =>  $recive_id,
                'voice' => $message->getVoice()->getFileId(),
                'caption' => $message->getCaption(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else if($message->has('audio'))
        {
            $response=Telegram::sendAudio([
                'chat_id' =>  $recive_id,
                'audio' => $message->getAudio()->getFileId(),
                'caption' => $message->getCaption(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        else {
            $response=Telegram::sendMessage([
                'chat_id' => $recive_id,
                // 'text' => $text
                'text' => $message->getText(),
                'reply_to_message_id' => $message->has('reply_to_message')?$reply_message_id:''
            ]);
        }
        Message::storeMessage($message,$response->getMessageId());
    }


    public function hasVoice()
    {
        return ($this->voice_id!=null ) ;
    }

    public function hasVideo()
    {
        return ($this->video_id!=null ) ;
    }

    public function hasAudio()
    {
        return ($this->audio_id!=null) ;
    }

    public function hasPhoto()
    {
        return ($this->photo_id!=null);
    }

    public function hasDocument()
    {
        return ($this->document_id!=null);
    }
    public function hasSticker()
    {
        return ($this->sticker_id!=null);
    }

    public function isReply()
    {
        return ($this->reply_message_id!=null);
    }




    public function renderMessage()
    {
        if($this->hasPhoto())
        {
            $view=View::make('layout.ui.messages.photomessage', ['message' => $this]);
            return $view;
        }
        else if($this->hasVoice())
        {
            $view=View::make('layout.ui.messages.voicemessage', ['message' => $this]);
            return $view;
        }
        else if($this->hasAudio())
        {
            $view=View::make('layout.ui.messages.audiomessage', ['message' => $this]);
            return $view;
        }
        else if($this->hasVideo())
        {
            $view=View::make('layout.ui.messages.videomessage', ['message' => $this]);
            return $view;
        }
        else if($this->hasSticker())
        {
            $view=View::make('layout.ui.messages.stickermessage', ['message' => $this]);
            return $view;
        }
        else if($this->hasDocument())
        {
            $view=View::make('layout.ui.messages.documentmessage', ['message' => $this]);
            return $view;
        }
        else{
            $view=View::make('layout.ui.messages.textmessage',['message' => $this]);
            return $view;
        }
    }

}
