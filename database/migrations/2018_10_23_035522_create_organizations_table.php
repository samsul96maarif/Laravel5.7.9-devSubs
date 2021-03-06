<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id')->unsigned();
          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->integer('subscription_id')->unsigned()->nullable($value = true);
          $table->foreign('subscription_id')->references('id')->on('subscriptions')->onDelete('cascade');
          $table->string('name', 30);
          $table->string('logo')->nullable();
          $table->string('phone', 12);
          $table->string('company_address');
          $table->integer('zipcode');
          $table->boolean('status')->default('0');
          $table->timestamp('expire_date')->nullable();
          $table->integer('writer_id')->unsigned();
          $table->foreign('writer_id')->references('id')->on('users')->onDelete('cascade');
          $table->string('action');
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
        Schema::dropIfExists('organizations');
    }
}
