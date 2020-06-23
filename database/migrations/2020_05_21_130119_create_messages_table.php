<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->bigInteger('id')->unique();
            $table->bigInteger('from');
            $table->bigInteger('forward_from')->nullable(true);
            $table->bigInteger('reply_message_id')->nullable(true);
            $table->longText('text')->nullable(true);
            $table->longText('audio_id')->nullable(true);
            $table->longText('document_id')->nullable(true);
            $table->longText('sticker_id')->nullable(true);
            $table->longText('voice_id')->nullable(true);
            $table->longText('video_id')->nullable(true);
            $table->longText('photo_id')->nullable(true);
            $table->longText('caption')->nullable(true);
            $table->longText('contact_id')->nullable(true);
            $table->foreign('from')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('sent_id')->nullable(true);
            $table->longText('entities')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('messages');
    }
}
