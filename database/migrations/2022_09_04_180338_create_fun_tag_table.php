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
        Schema::create('fun_tag', function (Blueprint $table) {
            $table->id();
            $table->foreignId('fun_id')
                ->constrained("funs")
                ->onUpdate('cascade');
            $table->foreignId('tag_id')
                ->constrained("tags")
                ->onUpdate('cascade')
                ;
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
        Schema::dropIfExists('fun_tag');
    }
};
