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
            $table->foreignId('user_id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->string('image')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('professional_license_number')->nullable();
            $table->string('commercial_registration_number')->nullable();
            $table->string('municipal_license_number')->nullable();
            $table->string('tax_establishment_number')->nullable();
            $table->string('country_code')->nullable();
            $table->string('city')->nullable();
            $table->integer('license_attachment')->nullable();
            $table->json("location")->nullable();
            $table->foreignId('service_id')->nullable();
            $table->foreignId('profession_id')->nullable();
            $table->float('hold_balance')->default(0);
            $table->float('available_balance')->default(0);
            $table->string('status')->default('UNCOMPLETED');
            $table->boolean('is_hidden')->default(0);
            $table->json('withdrawal_methods');
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
