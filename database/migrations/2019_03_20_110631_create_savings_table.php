<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->decimal('amount_saved',12,3)->nullable();
            $table->decimal('amount_withdrawn',12,3)->nullable();
            $table->date('entry_date');
            $table->string('saving_mode',20)->default('IPPIS');
            $table->string('bank_name',30)->nullable();
            $table->string('bank_add',50)->nullable();
            $table->string('depositor_name',50)->nullable();
            $table->integer('teller_no')->nullable();
            $table->string('notes',50)->nullable();
            $table->integer('created_by');
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
        Schema::dropIfExists('savings');
    }
}
