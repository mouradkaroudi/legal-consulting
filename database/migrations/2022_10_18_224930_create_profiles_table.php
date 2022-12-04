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
            $table->string('national_ID')->nullable();
            $table->string('national_id_attachment')->nullable();
            $table->enum('gender', ['male', 'female'])->nullable();
            $table->foreignId('original_country')->nullable();
            $table->json('experiences')->nullable();
            $table->json('education')->nullable();
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
