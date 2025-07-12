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
        Schema::create('assets', function (Blueprint $table) {
            $table->id();

            // Foreign key for bank_id, assuming a 'banks' table exists
            // If 'bank_id' is just an identifier and not a foreign key, use ->string('bank_id') instead
            $table->foreignId('bank_id')->constrained('banks', 'id')->restrictOnUpdate()->restrictOnDelete();
            
            $table->string('ministry_name')->nullable(); // Ministry name, can be null
            $table->string('department_name')->nullable(); // Department name, can be null
            $table->string('machine_name')->nullable(); // Machine name, e.g., 'Server'
            $table->string('department_no')->nullable(); // Department number, e.g., 'NEC-57'
            $table->string('brand_name')->nullable(); // Brand name, e.g., 'HPE'
            $table->string('make_name')->nullable(); // Make name, e.g., 'Malaysia'
            $table->string('model_name')->nullable(); // Model name, e.g., 'B1460c-Gen 10'
            $table->string('mother_board_name')->nullable(); // Motherboard name
            $table->string('memory_name')->nullable(); // Memory details, e.g., '32GB DDR4'
            $table->string('storage_device_name')->nullable(); // Storage device details, e.g., '1TB SSD'
            $table->string('monitor_name')->nullable(); // Monitor name, can be empty
            $table->string('multi_media_name')->nullable(); // Multi-media name, can be empty
            $table->string('number_name')->nullable(); // Number name, e.g., '1' (stored as string)
            $table->string('price_name')->nullable(); // Price, e.g., '10,747,080' (stored as string due to commas)
            $table->string('condition_name')->nullable(); // Condition, e.g., 'Serviceable'
            $table->string('budget_year_name')->nullable(); // Budget year, e.g., '2024-2025'
            $table->string('location_township_name')->nullable(); // Township location
            $table->string('location_region_name')->nullable(); // Region location
            $table->string('received_by_name')->nullable(); // Name of the person/entity who received it
            $table->text('remark_name')->nullable(); // Remarks, e.g., 'Primary server'

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
