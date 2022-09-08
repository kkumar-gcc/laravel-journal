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
        Schema::dropIfExists('subscribers');
        Schema::create('subscribers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->constrained("users")
                ->onUpdate('cascade');
            $table->foreignId('subscriber_id')
                ->constrained("users")
                ->onUpdate('cascade');
            // $table->boolean('status');
            //1 -> followed
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
        Schema::dropIfExists('subscribers');
    }
};
