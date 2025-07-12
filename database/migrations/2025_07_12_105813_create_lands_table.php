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
        Schema::create('lands', function (Blueprint $table) {
            $table->id();

            $table->string('building_owner_name')->nullable();
            $table->string('building_type_name')->nullable();
            $table->foreignId('region_id')->nullable()->constrained('regions')->onDelete('cascade');
            $table->foreignId('township_id')->nullable()->constrained('townships')->onDelete('cascade');
            $table->text('address')->nullable();
            $table->date('year_built')->nullable();
            $table->string('building_design_name')->nullable();
            $table->string('building_size')->nullable(); // Store as string to retain "sq ft"
            $table->string('building_area')->nullable(); // Store as string to retain "sq m"
            $table->string('land_size')->nullable(); // Store as string to retain "acres"
            $table->string('land_area')->nullable(); // Store as string to retain "sq m"
            $table->decimal('distributed_fund', 15, 2)->nullable();
            $table->decimal('price', 15, 2)->nullable();
            $table->boolean('is_currently_in_use')->default(true)->nullable();
            $table->text('currently_in_use_note')->nullable();
            $table->string('type_details')->nullable();
            $table->boolean('is_grant_owned')->default(false)->nullable();
            $table->text('grant_owned_note')->nullable();
            $table->integer('life_span')->nullable();
            $table->boolean('is_ownership_changed')->default(false)->nullable();
            $table->text('ownership_changed_note')->nullable();
            $table->boolean('is_land_owned')->default(true)->nullable();
            $table->text('land_owned_note')->nullable();
            $table->string('images')->nullable(); // Store image file names/paths
            $table->string('documents')->nullable(); // Store document file names/paths

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lands');
    }
};
