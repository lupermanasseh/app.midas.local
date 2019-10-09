<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('targetsrs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('monthly_saving',12,3)->nullable();
            $table->string('status')->default('Active');
            $table->date('start_date');
            $table->date('end_date');
            $table->date('review_date')->nullable();
            $table->mediumText('review_comment')->nullable();
            $table->integer('review_by'); //ID of the logged in staff
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
        Schema::dropIfExists('targetsrs');
    }
}
