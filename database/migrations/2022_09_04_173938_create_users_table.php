<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
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
            $table->string('uuid')->nullable()->unique();
            $table->string('email')->unique();
            $table->string('username')->unique();
            $table->string('name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->text('about_me')->nullable();
            $table->text('short_bio')->nullable();
            $table->string('location')->nullable();
            $table->text('work')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('background_image')->nullable();
            $table->string("portfolio_url")->nullable();
            $table->string('twitter_url')->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('stackoverflow_url')->nullable();
            $table->string('medium_url')->nullable();
            $table->string('quora_url')->nullable();
            $table->string('reddit_url')->nullable();
            $table->string('youtube_url')->nullable();
            $table->string('codepen_url')->nullable();
            $table->string('github_url')->nullable();
            $table->string('laracasts_url')->nullable();
            $table->boolean('show_follower')->default(true);
            $table->boolean('show_following')->default(true);
            $table->boolean('is_banned')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->dateTime('banned_at')->nullable();
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
};
