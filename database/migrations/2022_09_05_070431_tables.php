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
        Schema::create("users",function (Blueprint $table) {
           $table->id();
           $table->string('name')->unique();
           $table->string('email')->unique();
           $table->string('password');
           $table->integer('role')->default(0);
           $table->timestamps();
        });
        Schema::create("categories",function (Blueprint $table){
            $table->id();
            $table->string('name');
            $table->timestamps();

        });
        Schema::create("videos",function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')
                ->on('categories')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->string('file')->unique();
            $table->timestamps();
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('ban_status')->default(0);
        });
        Schema::create("comments",function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                ->on('users')->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->unsignedBigInteger('video_id');
            $table->foreign('video_id')->references('id')
                ->on('videos')->onDelete('CASCADE')->onUpdate('CASCADE');
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
        Schema::dropIfExists('videos');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('comments');



    }
};
