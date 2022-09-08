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
        Schema::create('replies', function (Blueprint $table) {
            $table->id();
            $table->string('uuid')->nullable()->unique();
            $table->text('description');
            $table->foreignId('comment_id')
                ->constrained("comments")
                ->onUpdate('cascade');
            $table->foreignId('user_id')
                ->constrained("users")
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->softDeletes();
            $table->timestamps();
            // $table->id();
            // $table->string('uuid')->nullable()->unique();
            // $table->text('description');
            // // $table->foreignId('comment_id')
            // //     ->constrained("comments")
            // //     ->onUpdate('cascade');
            // // $table->foreignId('user_id')
            // //     ->constrained("users")
            // //     ->onUpdate('cascade');
            // $table->bigInteger("likes")->nullable();
            // // $table->bigInteger("dislikes")->nullable();
            // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
};
