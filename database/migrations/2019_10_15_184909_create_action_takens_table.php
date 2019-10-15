<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActionTakensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('action_takens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries');
            $table->unsignedBigInteger('enquiry_detail_id')->nullable();
            $table->foreign('enquiry_detail_id')->references('id')->on('enquiry_details');
            $table->unsignedBigInteger('employee_id')->nullable();
            $table->foreign('employee_id')->references('id')->on('employees');
            $table->unsignedBigInteger('penalty_id');
            $table->string('description');
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('action_takens');
    }
}