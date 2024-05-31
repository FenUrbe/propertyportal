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
        Schema::create('user_plans', function (Blueprint $table) {
            $table->id();
            $table->integer('plan_id');
            $table->integer('user_id');
            $table->timestamp('start_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->double('paid_amount');
            $table->string('payer_id');
            $table->string('payment_id');
            $table->string('token');
            $table->text('approval_url');
            $table->tinyInteger('payment_success')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_plans');
    }
};
