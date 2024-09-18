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
        Schema::create('transaction_adminshops', function (Blueprint $table) {
            $table->id();
            $table->string('code_trx')->nullable();  
            $table->date('date');  
            $table->integer('total_price')->nullable();
            $table->integer('cash')->nullable();
            $table->integer('cash_back')->nullable(  );
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaction_adminshops');
    }
};
