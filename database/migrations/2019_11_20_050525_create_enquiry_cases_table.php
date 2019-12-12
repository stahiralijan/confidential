<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_cases', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('enquiry_no');
            $table->integer('employee_id')->nullable();
            $table->integer('designation_id');
            $table->integer('office_id');
            $table->integer('charges_id');
            $table->dateTime('issue_date');
            $table->integer('competent_authority_id');
            $table->boolean('is_finalized')->default(false);
            $table->integer('punishment_id')->nullable();
            $table->integer('imposing_authority_id')->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('enquiry_cases');
    }
}
