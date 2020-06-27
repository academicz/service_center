<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('registration_id')->unsigned();
            $table->string('product_name');
            $table->string('model');
            $table->string('company_name');
            $table->string('issue');
            $table->integer('service_center_id')->unsigned();
            $table->integer('status');
        });
        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreign('service_center_id')->references('id')->on('service_centers');
            $table->foreign('registration_id')->references('id')->on('registrations');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('service_requests');
    }
}
