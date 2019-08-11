<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductdeductionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('productdeductions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('psubscription_id');
            $table->integer('product_id');
            $table->decimal('monthly_deduction',12,3);
            $table->date('entry_date');
            $table->string('deduction_mode',10)->default('IPPIS');
            $table->string('bank_name',30)->nullable();
            $table->string('bank_add',50)->nullable();
            $table->string('depositor_name',50)->nullable();
            $table->string('teller_no',12)->nullable();
            $table->string('notes',20)->default('Normal Deductions');
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
        Schema::dropIfExists('productdeductions');
    }
}
