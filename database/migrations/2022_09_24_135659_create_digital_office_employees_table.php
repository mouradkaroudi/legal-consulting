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
        Schema::create('digital_office_employees', function (Blueprint $table) {
            $table->id();
            $table->integer('office_id');
            $table->integer('user_id');
            $table->string('role_name');
            $table->string('phone_number')->nullable();
            $table->string('national_id')->nullable();
            $table->string('degree')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->integer('profile_picture_id')->nullable();
            $table->integer('national_id_attachment')->nullable();
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
        Schema::dropIfExists('digital_office_employees');
    }
};
