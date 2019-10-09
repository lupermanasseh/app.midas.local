<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLdeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ldeductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id'); 
            $table->integer('product_id'); 
            $table->integer('lsubscription_id');
            $table->decimal('amount_deducted',20,9);
            $table->date('entry_month');
            $table->string('repayment_mode',10) ;
            $table->string('bank_name',30)->nullable();
            $table->string('bank_add',50)->nullable();
            $table->string('depositor_name',50)->nullable();
            $table->integer('teller_no')->nullable();
            $table->string('notes',50);
            $table->integer('uploaded_by');
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
        Schema::dropIfExists('ldeductions');
    }
}
