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
        Schema::create('detail_transaction_adminshops', function (Blueprint $table) {
            $table->id();
            $table->integer('transaction_adminshop_id');
            $table->string('name_sparepart')->nullable();
            $table->integer('storageracksparepart_id');
            $table->integer('workshop_id');
            $table->string('brand');
            $table->integer('qty');
            $table->integer('price');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transaction_adminshops');
    }
};
