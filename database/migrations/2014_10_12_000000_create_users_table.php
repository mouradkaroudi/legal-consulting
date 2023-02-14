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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->foreignId('country_id')->nullable();
            $table->string('avatar_url')->nullable();
            $table->string('ID_number')->nullable();
            $table->string('ID_image')->nullable();
            $table->string('driving_license_image')->nullable();
            $table->float('hold_balance')->default(0);
            $table->float('available_balance')->default(0);
            $table->foreignId('current_office_id')->nullable();
            $table->boolean('contact_hidden_offices')->default(0);
            $table->json('withdrawal_methods')->nullable();
            $table->rememberToken();
            $table->timestamp('last_seen_at')->nullable();
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
        Schema::dropIfExists('users');
    }
};
