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
        Schema::create('institution_masters', function (Blueprint $table) {
            $table->id();
            $table->string('institution_name')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('designation')->nullable(); 
            $table->string('email')->nullable();
            $table->string('password')->nullable();
            $table->enum('is_registered',array('yes','no'))->nullable();
            $table->longText('address')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->tinyInteger('active_status');
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
        Schema::dropIfExists('institution_masters');
    }
};
