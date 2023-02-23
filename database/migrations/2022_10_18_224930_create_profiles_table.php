<?php

use App\Models\Profile;
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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->json('experiences')->nullable();
            $table->json('education')->nullable();
            $table->string('car_license_image')->nullable();
            $table->string('professional_license_number')->nullable();
            $table->string('professional_license_image')->nullable();
            $table->string('status')->default(Profile::UNCOMPLETED); // available, busy, uncompleted
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
        Schema::dropIfExists('profiles');
    }
};
