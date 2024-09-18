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
        Schema::create('audit_storages', function (Blueprint $table) {
            $table->id();
            $table->integer('storageracksparepart_id');
            $table->date('date');
            $table->integer('qty');
            $table->integer('loss');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_storages');
    }
};
