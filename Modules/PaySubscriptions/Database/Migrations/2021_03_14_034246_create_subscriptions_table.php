<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('package_id')->unsigned();
            $table->integer('created_id')->unsigned()->nullable()->comment('Auth user or null');
            $table->enum('status', ['approved', 'waiting', 'declined'])->default('waiting');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->date('trial_end_date')->nullable();
            $table->decimal('package_price', 22, 4);
            $table->longText('package_details');
            $table->string('paid_via')->nullable();
            $table->string('payment_transaction_id')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->index('package_id');
            $table->index('created_id');
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
        Schema::dropIfExists('subscriptions');
    }
}
