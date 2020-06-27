<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReturnInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('return_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('service_request_id');
            $table->date('return_date')->nullable();
            $table->time('return_time')->nullable();
            $table->string('return_address')->nullable();
            $table->string('return_location')->nullable();
            $table->string('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('return_infos');
    }
}
