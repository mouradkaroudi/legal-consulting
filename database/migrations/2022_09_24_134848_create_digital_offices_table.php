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
        Schema::create('digital_offices', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('license_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            // $table->integer('image_id')->nullable();
            $table->integer('license_attachment')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('status')->default('uncomplete');
            $table->timestamp('banned_at')->nullable();
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
        Schema::dropIfExists('digital_offices');
    }
};
