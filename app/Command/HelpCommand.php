<?php

namespace App\Command;

use App\User;
use Telegram\Bot\Commands\Command;
use Telegram\Bot\Helpers\Emojify;
use Telegram\Bot\Laravel\Facades\Telegram;

/**
 * Class HelpCommand.
 */
class HelpCommand extends Command
{
    /**
     * @var string Command Name
     */
    protected $name = 'help';

    /**
     * @var array Command Aliases
     */
    protected $aliases = ['helpmessage'];

    /**
     * @var string Command Description
     */
    protected $description = 'Help command';

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
        $response = Telegram::sendMessage([
            'chat_id' => $sender->getId(),
            'text' =>'This bot connects you to sellers with many attractive products.
به بات کانال ریویورز خوش امدید . این بات شما رو به فروشنده ها با کالاهای جذاب وصل میکنه'.Emojify::text(':hourglass:').Emojify::text(':hourglass:'),
        ]);

    }
}
