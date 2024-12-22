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
        Schema::create('record_record_category', function (Blueprint $table) {
            $table->id();
            $table->foreignId('record_id')->constrained()->cascadeOnDelete();
            $table->foreignId('record_category_id')->constrained()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('record_record_category');
    }
};
