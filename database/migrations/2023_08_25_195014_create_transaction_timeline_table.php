<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transaction_timeline', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->integer('time_spent');
            $table->integer('attempts');
            $table->string('authentication')->nullable();
            $table->integer('errors');
            $table->boolean('success');
            $table->boolean('mobile');
            $table->string('channel');
            $table->json('input')->nullable();
            $table->json('history')->nullable();
            $table->timestamps();

            // Add foreign key relationship
            $table->foreign('transaction_id')->references('id')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_timeline');
    }
};
