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
        Schema::create('specialization_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('specialization_id');
            $table->string('locale')->index();
            $table->string('name');
            $table->string('slug');

            $table->unique(['specialization_id', 'locale']);
            $table->foreign('specialization_id')->references('id')->on('specializations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('specialization_translations');
    }
};
