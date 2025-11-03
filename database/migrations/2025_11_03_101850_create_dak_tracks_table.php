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
        Schema::create('dak_tracks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dak_address_id')->constrained()->onDelete('cascade');
            $table->string('qrcode')->unique();
            $table->string('status')->default('received');
            $table->string('location')->nullable();
            $table->timestamp('scanned_at')->useCurrent();
            $table->foreignId('scanned_by')->nullable()->constrained('admins');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dak_tracks');
    }
};