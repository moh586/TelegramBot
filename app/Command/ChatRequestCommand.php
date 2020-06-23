<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 18/05/2020
 * Time: 07:21 PM
 */


namespace App\Command;

use App\Chat;
use App\User;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class ChatRequestCommand extends Command
{

    /**
     * @var string Command Name
     */
    protected $name = 'chat_request';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['chatrequest'];

    /**
     * @var string Command Description
     */
    protected $description = 'Send a Request to start a anonymous chat';



    /**
     * {@inheritdoc}
     */
    public function handle()
    {

        $sender=$this->getUpdate()->getMessage()->getFrom();
        $owner=User::find($sender->getId());
        if(!$owner->activated)
        {
            $owner->sendMessage('Sorry.You are Block.Please Contact Admin'.Emojify::text(':pray:').Emojify::text(':pray:'));
            return true;
        }
        User::checkUserExiste($sender);

        //



        if(Chat::hasActiveChat($sender->getId()))
        {

            $reply_markup=Keyboard::make()
                ->row(
                    [Keyboard::button(['text' => 'Yes', 'callback_data' => "endChat"]),
                        Keyboard::button(['text' => 'No', 'callback_data' => "resumChat"])  ]
                )->setOneTimeKeyboard(true)->setResizeKeyboard(true);



            $response = Telegram::sendMessage([
                'chat_id' => $sender->getId(),
                'text' => 'Are you sure to end the last chat?',
                'reply_markup' => $reply_markup
            ]);

            return true;
        }



        $reply_markup=Keyboard::make()->inline()
        ->row(Keyboard::inlineButton(['text' => 1, 'callback_data' => "seller"]));



        $response = Telegram::sendMessage([
            'chat_id' => $sender->getId(),
            'text' => 'Please Select Seller Code',
            'reply_markup' => $reply_markup
        ]);

        $messageId=$response->getMessageId();
        $chatId=$response->getChat()->getId();
            //
        $sellers=User::getSellers();
        $reply_markup=Keyboard::make()
            //Keyboard::button(['text' => '1', 'callback_data' => "seller1"])
            ->inline()
            ->setOneTimeKeyboard(true)
            ->setResizeKeyboard(true);
        $i=0;
        foreach ($sellers as $seller)
        {
            $reply_markup->row(Keyboard::inlineButton(['text' => ++$i, 'callback_data' => "seller&".$seller->id."&".$chatId."&".$messageId]));
        }

        Telegram::editMessageReplyMarkup([
            'chat_id'=>$chatId,
            'message_id'=>$messageId,
            'reply_markup' => $reply_markup
        ]);
    }
}