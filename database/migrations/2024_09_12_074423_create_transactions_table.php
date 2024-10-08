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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->string('code_trx');
            $table->date('date');
            $table->integer('customer_id');
            $table->integer('workshop_id');
            $table->integer('storageracksparepart_id');
            $table->integer('total_price')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('cash_back')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
