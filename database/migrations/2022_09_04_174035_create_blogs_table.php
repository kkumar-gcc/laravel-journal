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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->unique();
            $table->string('title');
            $table->string("slug")->nullable();
            $table->string('cover_image')->nullable();
            $table->text('body');
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->enum("status", ['posted', 'drafted']);
            $table->enum("access", ['public', 'private','subscriber'])->default('public');
            $table->enum("comment_access", ['enable', 'disable'])->default('enable');
            $table->boolean("adult_warning")->default(false);
            $table->boolean("age_confirmation")->default(false);
            $table->boolean("is_pinned")->default(false);
            $table->bigInteger("likes")->nullable();
            $table->bigInteger("dislikes")->nullable();
            $table->bigInteger("views")->nullable();
            $table->bigInteger("bookmarks")->nullable();
            $table->foreignId('user_id')
                ->constrained("users")
                ->onUpdate('cascade');
            $table->softDeletes();
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
        Schema::dropIfExists('blogs');
    }
};
