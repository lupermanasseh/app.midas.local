<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->bigInteger('payment_number')->unique();
            $table->string('password');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('title');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('other_name')->nullable();
            $table->string('sex');
            $table->string('staff_no');
            $table->date('dofa');
            $table->string('membership_type');
            $table->string('dept');
            $table->string('phone');
            $table->string('marital_status');
            $table->string('home_add');
            $table->string('res_add');
            $table->date('dob');
            $table->string('employ_type');
            $table->string('job_cadre');
            $table->string('status')->default('Active');
            $table->string('photo')->nullable();
            $table->rememberToken();
            $table->date('date_entry');
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
