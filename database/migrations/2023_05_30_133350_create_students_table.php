<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->longText('avatar')->nullable();
            $table->string('fullname')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->string('gender')->nullable();
            $table->string('country')->nullable();
            $table->string('state')->nullable();
            $table->string('course_id')->nullable();
            $table->string('course_start_date')->nullable();
            $table->string('course_end_date')->nullable();
            $table->integer('passing_year')->nullable();
            $table->string('year_level')->nullable();
            $table->integer('institution_id')->nullable();
            $table->enum('is_registered',array('yes','no'))->default('no');
            $table->string('institution_name')->nullable();
            $table->tinyInteger('active_status');
            $table->string('temp_user_id')->nullable();
            $table->tinyInteger('other_institution_flag')->default(0);
            $table->enum('is_payment_done',array('yes','no'))->default('no');
            $table->enum('is_approved',array('yes','no'))->default('no');
            $table->string('otp')->nullable();
            $table->string('otp_expiry')->nullable();
            $table->string('otp_type')->nullable();
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
        Schema::dropIfExists('students');
    }
};
