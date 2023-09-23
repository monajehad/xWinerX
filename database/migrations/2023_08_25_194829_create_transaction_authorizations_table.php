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
    

        Schema::create('transaction_authorizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->string('authorization_code');
            $table->string('bin');
            $table->string('last4');
            $table->unsignedTinyInteger('exp_month');
            $table->unsignedSmallInteger('exp_year');
            $table->string('card_type');
            $table->string('bank');
            $table->string('country_code');
            $table->string('brand');
            $table->boolean('reusable');
            $table->string('signature');
            $table->string('account_name')->nullable();

            // Define foreign key constraint
            $table->foreign('transaction_id')
                ->references('id')
                ->on('transactions')
                ->onDelete('cascade');
                $table->timestamps();

        });

    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_authorizations');
    }
};
