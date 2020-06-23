<?php
/**
 * Created by PhpStorm.
 * User: Joneidi
 * Date: 18/05/2020
 * Time: 07:21 PM
 */


namespace App\Command;

use App\Role;
use App\User;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Keyboard\Keyboard;
use Telegram\Bot\Laravel\Facades\Telegram;

class RegisterSellerCommand extends Command
{

    /**
     * @var string Command Name
     */
    protected $name = 'register_seller';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['registerseller'];

    /**
     * @var string Command Description
     */
    protected $description = 'Register Seller Command ,add sender as a Seller after approving by Admins';



    /**
     * {@inheritdoc}
     */
    public function handle()
    {
        $sender=$this->getUpdate()->getMessage()->getFrom();
        $owner=User::find($sender->getId());
        if(!is_null($owner)&&!$owner->activated)
        {
            $owner->sendMessage('Sorry.You are Block.Please Contact Admin'.Emojify::text(':pray:').Emojify::text(':pray:'));
            return true;
        }

        $adminRole = Role::whereName('admin')->first();

        $customer=User::find($sender->getId());

        $keyboard = Keyboard::make()
            ->inline()
            ->row(
                Keyboard::inlineButton(['text' => 'Approve', 'callback_data' => "approve_seller&".$sender->getId()."&".$sender->getFirstName()."&".$sender->getLastName()."&".$sender->getUsername()])
            );

        $admins=User::where('role_id',$adminRole->id)->where('activated',true)->get();
        $verify_message= 'Please Verify '.$sender->getFirstName()." ".$sender->getLastName()."(".$sender->getUsername().") as a Seller";

        foreach ($admins as $user)
        {
            $response = Telegram::sendMessage([
                'chat_id' => $user->id,
                'text' =>$verify_message,
                'reply_markup' => $keyboard
            ]);
        }

        //
        $response = Telegram::sendMessage([
            'chat_id' => $customer->id,
            'text' =>'your request is pending '.Emojify::text(':hourglass:').Emojify::text(':hourglass:'),
        ]);
        $customer->extra=$response->getMessageId();
        $customer->save();
    }
}