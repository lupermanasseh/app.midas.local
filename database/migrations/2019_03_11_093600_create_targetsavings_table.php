<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTargetsavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //This table is used to upload information about target saving deductions
        Schema::create('targetsavings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('targetsr_id');
            $table->decimal('amount',12,3);
            $table->date('entry_date');
            $table->string('target_saving_mode',10)->default('IPPIS');
            $table->string('bank_name',30)->nullable();
            $table->string('bank_add',50)->nullable();
            $table->string('depositor_name',50)->nullable();
            $table->integer('teller_no')->nullable();
            $table->string('notes',20)->default('Normal Deductions');
            $table->integer('created_by'); //ID of the logged in staff
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
        Schema::dropIfExists('targetsavings');
    }
}
