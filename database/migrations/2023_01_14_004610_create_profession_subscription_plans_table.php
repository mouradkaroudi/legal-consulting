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
        Schema::create('profession_subscription_plans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profession_id');
            $table->string('name');
            $table->string('description');
            $table->float('fee');
            $table->enum('type', ['one-time', 'monthly', 'yearly']);
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
        Schema::dropIfExists('profession_subscription_fees');
    }
};
