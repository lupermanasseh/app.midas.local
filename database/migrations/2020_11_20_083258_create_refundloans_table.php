<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefundloansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refundloans', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('product_id',false,true)->length(10);
          $table->integer('user_id',false,true)->length(10);
          $table->decimal('credit',12,2)->nullable();
          $table->decimal('debit',12,2)->nullable();
          $table->decimal('refund_balance',12,2);
          $table->string('status')->default('Active');
          $table->date('transaction_date')->nullable();
          $table->string('reference')->nullable();
          $table->string('description')->nullable();
          $table->string('created_by'); //ID of the logged in staff
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
        Schema::dropIfExists('refundloans');
    }
}
