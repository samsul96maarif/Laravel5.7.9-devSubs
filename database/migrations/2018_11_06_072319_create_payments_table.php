<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('uniq_code');
          $table->integer('organization_id')->unsigned();
          $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
          $table->integer('subscription_id')->unsigned();
          $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
          $table->string('subscription_name', 20);
          $table->string('proof')->nullable();
          $table->integer('amount');
          $table->boolean('paid')->default('0');
          $table->integer('period')->default(1);
          $table->timestamps();
          $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
