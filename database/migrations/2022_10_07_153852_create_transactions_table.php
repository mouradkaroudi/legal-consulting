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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->float('amount');
            $table->enum('type', ['debit', 'credit']);
            $table->string('source'); // deposit, payment, earning, refund
            $table->string('status');
            $table->timestamps();
            $table->timestamp('due_date')->nullable();
            $table->longText('metadata')->nullable();
            $table->morphs('transactionable');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
