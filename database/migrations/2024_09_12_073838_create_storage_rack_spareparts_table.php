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
        Schema::create('storage_rack_spareparts', function (Blueprint $table) {
            $table->id();
            $table->integer('storagerack_id');
            $table->integer('sparepart_id');
            $table->integer('buy')->nullable();
            $table->integer('sell')->nullable();
            $table->integer('qty')->nullable();
            $table->varchar('row')->nullable();
            $table->varchar('column')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('storage_rack_spareparts');
    }
};
