<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatMessage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create ('chat_message', function (Blueprint $table) {
            $table->bigInteger('chat_id');
            $table->bigInteger('message_id');
            $table->foreign('chat_id')->references('id')->on('chats')->onDelete('cascade');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->primary(['chat_id', 'message_id']);
            //
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('chat_message', function (Blueprint $table) {
            //
        });
    }
}
