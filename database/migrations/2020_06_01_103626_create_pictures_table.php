<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePicturesTable extends Migration
{

    public function up():void
    {
        Schema::create('pictures', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('caption')->nullable();
            $table->string('location')->nullable();
            $table->timestamps();

            $table->index('user_id');
        });
    }

    public function down():void
    {
        Schema::dropIfExists('pictures');
    }
}
