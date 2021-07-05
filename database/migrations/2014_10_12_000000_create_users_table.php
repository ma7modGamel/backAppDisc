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
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('gender_id');
            $table->string('bio', 250)->nullable();
            $table->string('image')->nullable();
            $table->integer('like_count')->default(0);
            $table->integer('call_count')->default(0);
            $table->boolean('is_vip')->default(false);
            $table->boolean('is_admin')->default(false);


            $table->rememberToken();
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
