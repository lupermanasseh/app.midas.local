<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMasterdeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('masterdeductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('ippis_no');
            $table->decimal('cumulative_amount',12,3);
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
        Schema::dropIfExists('masterdeductions');
    }
}
