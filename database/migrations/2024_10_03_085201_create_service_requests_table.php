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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id('request_id'); // Auto-incrementing primary key
            $table->unsignedBigInteger('user_id'); // FK to categories
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');// FK to categories  // The user who made the booking
            
            $table->unsignedBigInteger('service_id'); // FK to categories
            $table->foreign('service_id')->references('service_id')->on('services')->onDelete('cascade');// FK to categories// The booked service
        
            $table->unsignedBigInteger('provider_id'); // FK to categories
          $table->foreign('provider_id')->nullable()->references('provider_id')->on('service_providers')->onDelete('cascade');// FK to categories// The booked service
      
          // FK to service providers
            $table->string('title'); // Title of the service request
            $table->text('description')->nullable(); // Description of the service request
            $table->date('date_of_done')->nullable(); // Date when the service is expected to be done
            $table->string('location'); // Location for the service
            $table->decimal('expected_cost', 10, 2)->nullable(); // Expected cost for the service
            $table->longText('pictures')->nullable(); // Store Base64 encoded picture data as longText
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending'); // Status of the request
            $table->timestamps(); // Timestamps for created_at and updated_at
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};