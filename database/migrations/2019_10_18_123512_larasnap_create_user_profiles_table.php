<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class LarasnapCreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
			$table->bigIncrements('id');
			$table->bigInteger('user_id')->unsigned();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->bigInteger('mobile_no')->nullable();
            $table->longText('address')->nullable();
            $table->string('state')->nullable();			
			$table->string('city')->nullable();
            $table->bigInteger('pincode')->nullable();
            $table->string('user_photo')->nullable();
            $table->string('agency_name')->nullable();
            // $table->string('type')->nullable();
            $table->string('emp_id')->nullable();
            $table->timestamps();
			
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('userprofiles');
    }
}
