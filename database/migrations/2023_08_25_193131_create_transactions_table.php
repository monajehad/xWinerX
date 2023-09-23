<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('domain');
            $table->string('status');
            $table->string('reference')->unique();
            $table->integer('amount');
            $table->integer('requested_amount');
            $table->string('message')->nullable();
            $table->string('gateway_response');
            $table->timestamp('paid_at')->nullable();
            $table->string('channel');
            $table->string('currency');
            $table->string('ip_address')->nullable();
            $table->json('metadata')->nullable();
            $table->integer('fees')->nullable();
            $table->json('fees_split')->nullable();
            $table->integer('authorization_id');

            // $table->unsignedBigInteger('authorization_id');
            // $table->foreign('authorization_id')->references('id')->on('transaction_authorizations')->onDelete('cascade');

            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('campaign_id')->nullable();
            
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->index('reference');
            $table->timestamps();

        });
        // DB::statement('ALTER TABLE transactions ADD CONSTRAINT transactions_authorization_id_foreign FOREIGN KEY (authorization_id) REFERENCES transaction_authorizations(id) ON DELETE CASCADE');

    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
