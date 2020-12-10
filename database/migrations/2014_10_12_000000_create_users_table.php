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
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password')->default(
                \Illuminate\Support\Facades\Hash::make(\Illuminate\Support\Str::random(8))
            );

            $table->string('role')->default(User::ROLE_USER);
            $table->integer('rating')->default(0);

            // Additional
            $table->string('city')->nullable();
            $table->string('address')->nullable();

            $table->text('profile_photo_path')->nullable();
            $table->foreignId('current_team_id')->nullable();
            $table->rememberToken();
            $table->timestamp('email_verified_at')->nullable();
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
        Schema::dropIfExists('users');
    }
}
