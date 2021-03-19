<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->string('name');
            $table->text('description');
            $table->enum('interval', ['days', 'months', 'years'])->default('months');
            $table->integer('interval_count')->default(1);
            $table->integer('trial_days')->default(0);
            $table->decimal('price', 22, 4);
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->nullable();
            $table->boolean('is_private')->nullable();
            $table->boolean('is_one_time')->nullable();
            $table->boolean('enable_custom_link')->nullable();
            $table->string('custom_link')->nullable();
            $table->string('custom_link_text')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('packages');
    }
}
