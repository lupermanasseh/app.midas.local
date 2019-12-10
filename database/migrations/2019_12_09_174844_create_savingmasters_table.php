<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSavingmastersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('savingmasters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->integer('ippis_no');
            $table->decimal('saving_cumulative',12,9);
            $table->decimal('ts_cumulative',12,9);
            $table->decimal('total',12,9);
            $table->date('entry_date');
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
        Schema::dropIfExists('savingmasters');
    }
}
