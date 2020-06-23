<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigInteger('id')->primary();
            $table->string('first_name')->nullable(true);
            $table->string('last_name')->nullable(true);
            $table->string('username')->nullable(true);
            $table->string('password');
            $table->string('avatar')->default('avatar.png');
            $table->boolean('activated')->default(true);
            $table->string('token');
            $table->unsignedInteger('role_id')->index();
            $table->foreign('role_id')->references('id')->on('roles');
            $table->rememberToken();
            $table->string('extra')->default(null);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
