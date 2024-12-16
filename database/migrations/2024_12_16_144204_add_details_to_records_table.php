<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up(): void
    {
        Schema::table('records', function (Blueprint $table) {
            $table->after('name', function (Blueprint $table) {
                $table->string('artist')->nullable();
                $table->string('label')->nullable();
                $table->string('code')->nullable();
                $table->string('genre')->nullable();
                $table->string('country')->nullable();
                $table->timestamp('release_date')->nullable();
                $table->string('format')->default('LP');
                $table->integer('rpm')->nullable();
                $table->string('color')->nullable();
                $table->boolean('is_limited_edition')->default(false);
                $table->integer('edition_number')->nullable();
                $table->string('condition')->nullable();
                $table->string('barcode')->nullable();
                $table->integer('total_tracks')->nullable();
                $table->string('spine_title')->nullable();
                $table->text('notes')->nullable();
            });
        });
    }
};
