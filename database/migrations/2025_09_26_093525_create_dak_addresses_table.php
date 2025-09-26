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
        Schema::create('dak_addresses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('unit_user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('unit_people_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('from_name');
            $table->string('from_address');
            $table->string('security_type');
            $table->string('letter_no');
            $table->string('to_name');
            $table->string('to_address');
            $table->date('date');
            $table->string('barcode')->unique();
            $table->enum('status', ['pending', 'received'])->default('pending');
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dak_addresses');
    }
};
