<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('f_name'); 
            $table->string('l_name'); 
            $table->string('email')->unique();
            $table->string('password');
            $table->string('phone')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('os'); 
            $table->date('birthday'); 
            $table->longText('profile_photo')->nullable();
            $table->string('country')->nullable(); 
            $table->integer('maxDistance')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}