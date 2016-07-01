<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function ($table) {
            $table->increments('id');
            $table->string('email');
            $table->string('name')->nullable()->unique();
            $table->timestamps();
            $table->string('phone');
            $table->string('skype');
            $table->date('date_of_contract')->default('2016-01-01');
            $table->integer('discount')->default(0);
            $table->integer('manager')->default(1);
            $table->string('avatar')->default('upload/avatars/user_default_image.jpg');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('customers');
    }
}
