<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket', function (Blueprint $table) {
            $table->integer('ticket_no')->autoIncrement();
            $table->unsignedInteger('customer_id');
            $table->unsignedInteger('emp_id');
            $table->foreign('customer_id')->references('id')->on('customer')->onDelete('cascade');
            $table->foreign('emp_id')->references('id')->on('employee')->onDelete('cascade');
            $table->string('Information');
            $table->string('status');
            $table->string('updated_at');
            $table->string('created_at');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket');
    }
}
