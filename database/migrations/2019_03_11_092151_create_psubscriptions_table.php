<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePsubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('psubscriptions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('product_id');
            //$table->integer('guarantor_id'); //USE IPPIS NUMBER TO FIND USER ID
            $table->integer('units');
            $table->decimal('total_amount',12,3);
            $table->decimal('monthly_repayment',20,9);
            $table->string('status',10)->default('Pending');
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullabe();
            $table->decimal('net_pay',12,3);
            $table->mediumText('review_comment')->nullable();
            $table->integer('staff_id');
            $table->integer('review_by')->nullable(); //ID of the logged in user/staff
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
        Schema::dropIfExists('psubscriptions');
    }
}
