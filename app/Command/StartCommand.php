<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 18/05/2020
 * Time: 07:21 PM
 */


namespace App\Command;

use App\CustomKeyboard;
use App\Role;
use App\User;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Laravel\Facades\Telegram;

class StartCommand extends Command
{

    /**
     * @var string Command Name
     */
    protected $name = 'start';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['startcommand'];

    /**
     * @var string Command Description
     */
    protected $description = 'Join and register channel';



    /**
     * {@inheritdoc}
     */
    public function handle()
    {

        $sender=$this->getUpdate()->getMessage()->getFrom();
        User::checkUserExiste($sender);
        $user=User::find($sender->getId());
        if(/*!is_null($owner)&&*/!$user->activated)
        {
            $user->sendMessage('Sorry.You are Block.Please Contact Admin'.Emojify::text(':pray:').Emojify::text(':pray:'));
            return true;
        }
        //

       // $user=User::find($sender->getId());


        if($user->isCustomer())
        {
            $response = Telegram::sendMessage([
                'chat_id' => $user->id,
                'text' =>$user->first_name . " ".$user->last_name .'  WelCome to Reviews Channel '.Emojify::text(':tada:'),
                'reply_markup' => CustomKeyboard::DefaultKeyboard()
            ]);
        }
        else if($user->isSeller())
        {
            $response = Telegram::sendMessage([
                'chat_id' => $user->id,
                'text' =>$user->first_name . " ".$user->last_name .'  WelCome to Reviews Channel '.Emojify::text(':tada:'),
                'reply_markup' => CustomKeyboard::SellerDefaultKeyboard()
            ]);
        }
        else if($user->isAdmin())
        {
            $response = Telegram::sendMessage([
                'chat_id' => $user->id,
                'text' =>$user->first_name . " ".$user->last_name .'  WelCome to Reviews Channel '.Emojify::text(':tada:'),
                'reply_markup' => CustomKeyboard::AdminDefaultKeyboard()
            ]);
        }


    }
}