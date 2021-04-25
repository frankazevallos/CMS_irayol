<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('mobile')->nullable();
            $table->string('gender')->nullable();
            $table->date('date_of_birth')->nullable();

            $table->string('url_website')->nullable();
            $table->string('url_facebook')->nullable();
            $table->string('url_twitter')->nullable();
            $table->string('url_instagram')->nullable();
            $table->string('url_linkedin')->nullable();
            $table->string('url_github')->nullable();

            $table->string('country', 100)->nullable();
            $table->string('state', 100)->nullable();
            $table->string('city', 100)->nullable();

            $table->text('bio')->nullable();
            $table->string('avatar')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_profiles');
    }
}
