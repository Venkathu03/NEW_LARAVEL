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
        Schema::create('procedure_trial_marks', function (Blueprint $table) {
            $table->id();
            $table->string('procedure_id')->nullable();
            $table->integer('procedure_type_id')->nullable();
            $table->integer('student_id')->nullable();
            $table->string('score')->nullable();
            $table->string('mac_address')->nullable();
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
        Schema::dropIfExists('procedure_trial_marks');
    }
};
