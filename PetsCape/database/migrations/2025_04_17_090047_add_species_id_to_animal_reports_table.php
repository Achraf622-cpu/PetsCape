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
        Schema::table('animal_reports', function (Blueprint $table) {
            $table->foreignId('species_id')->constrained('species');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Check if the table exists before attempting to modify it
        if (Schema::hasTable('animal_reports')) {
            Schema::table('animal_reports', function (Blueprint $table) {
                $table->dropForeign(['species_id']);
                $table->dropColumn('species_id');
            });
        }
    }
};
