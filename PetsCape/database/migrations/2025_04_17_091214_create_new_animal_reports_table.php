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
        // Drop the old table and recreate it
        Schema::dropIfExists('animal_reports');
        
        Schema::create('animal_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('species_id')->constrained('species');
            $table->string('name')->nullable();
            $table->string('breed')->nullable();
            $table->integer('age')->nullable();
            $table->string('gender')->nullable();
            $table->text('description');
            $table->string('location');
            $table->string('contact_name');
            $table->string('contact_email');
            $table->string('contact_phone');
            $table->boolean('is_found')->default(false);
            $table->string('image')->nullable();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamp('date_reported');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('animal_reports');
    }
};
