<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Laravel\Facades\Telegram;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/





Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::post('/bot', 'TelegramBotController@bot')->name('bot');

Route::post('/bot/getupdates', function() {
     $updates = Telegram::getWebhookUpdates();

     //Log::debug(json_encode($updates));
     //return (json_encode($updates));
    $update_id=$updates->getUpdateId();
    $message=$updates->getMessage();
    $chat=$message->getChat();
    $text=$message->getText();
    $send_id=110699273;
    if($message->getFrom()->getId()==110699273)
        $send_id=482979810;



    $response = Telegram::sendMessage([
        'chat_id' => $send_id,
       // 'text' => $text
        'text' => json_encode($updates)
    ]);

    $messageId = $response->getMessageId();
    return $messageId;
});
