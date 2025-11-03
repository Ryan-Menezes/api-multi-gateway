<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('client_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->foreignId('gateway_id')->constrained()->cascadeOnUpdate()->restrictOnDelete();
            $table->string('external_id');
            $table->unsignedTinyInteger('status');
            $table->unsignedInteger('amount');
            $table->string('card_last_numbers');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
