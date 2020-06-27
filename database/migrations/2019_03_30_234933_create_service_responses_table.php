<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('service_request_id')->unsigned();
            $table->date('pickup_date')->nullable();
            $table->time('pickup_time')->nullable();
            $table->string('pickup_address')->nullable();
            $table->string('pickup_location')->nullable();
            $table->integer('advance_amount')->nullable();
            $table->date('expected_return_date')->nullable();
            $table->integer('status');
        });
        Schema::table('service_responses', function (Blueprint $table) {
            $table->foreign('service_request_id')->references('id')->on('service_requests');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_responses');
    }
}
