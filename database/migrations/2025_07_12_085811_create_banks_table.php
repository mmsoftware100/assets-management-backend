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
        Schema::create('banks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('region_id')->constrained('regions', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('township_id')->constrained('townships', 'id')->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('bank_type_id')->constrained('bank_types', 'id')->restrictOnUpdate()->restrictOnDelete();
            // latitude and longitude can be added if needed
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
            // address and other fields can be added as needed
            // add timestamps for created_at and updated_at
            $table->string('address')->nullable(); // Example address field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banks');
    }
};
