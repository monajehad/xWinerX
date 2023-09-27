<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->string('card_type'); // Card type (e.g., Visa, MasterCard)
            $table->string('card_last_four'); // Last four digits of the card
            $table->string('card_number'); // Full card number (consider encrypting or using a tokenization service for security)
        });
    }

    public function down()
    {
        Schema::table('payment_methods', function (Blueprint $table) {
            $table->dropColumn('card_type');
            $table->dropColumn('card_last_four');
            $table->dropColumn('card_number');
        });
    }
};
