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
        if (Schema::hasTable('animal_reports')) {
            Schema::table('animal_reports', function (Blueprint $table) {
                if (!Schema::hasColumn('animal_reports', 'name')) {
                    $table->string('name')->nullable();
                }
                
                if (!Schema::hasColumn('animal_reports', 'breed')) {
                    $table->string('breed')->nullable();
                }
                
                if (!Schema::hasColumn('animal_reports', 'age')) {
                    $table->integer('age')->nullable();
                }
                
                if (!Schema::hasColumn('animal_reports', 'gender')) {
                    $table->string('gender')->nullable();
                }
                
                if (Schema::hasColumn('animal_reports', 'contact_info')) {
                    // Check if new columns exist first
                    if (!Schema::hasColumn('animal_reports', 'contact_name')) {
                        $table->string('contact_name')->nullable();
                    }
                    
                    if (!Schema::hasColumn('animal_reports', 'contact_email')) {
                        $table->string('contact_email')->nullable();
                    }
                    
                    if (!Schema::hasColumn('animal_reports', 'contact_phone')) {
                        $table->string('contact_phone')->nullable();
                    }
                    
                    // Drop the old column
                    $table->dropColumn('contact_info');
                }
                
                if (Schema::hasColumn('animal_reports', 'date_found') && 
                    !Schema::hasColumn('animal_reports', 'date_reported')) {
                    $table->renameColumn('date_found', 'date_reported');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('animal_reports')) {
            Schema::table('animal_reports', function (Blueprint $table) {
                $columns = ['name', 'breed', 'age', 'gender'];
                
                foreach ($columns as $column) {
                    if (Schema::hasColumn('animal_reports', $column)) {
                        $table->dropColumn($column);
                    }
                }
                
                if (!Schema::hasColumn('animal_reports', 'contact_info') &&
                    Schema::hasColumn('animal_reports', 'contact_name') &&
                    Schema::hasColumn('animal_reports', 'contact_email') &&
                    Schema::hasColumn('animal_reports', 'contact_phone')) {
                    
                    $table->string('contact_info')->nullable();
                    
                    // No way to automatically migrate data back in down method
                    
                    $table->dropColumn(['contact_name', 'contact_email', 'contact_phone']);
                }
                
                if (Schema::hasColumn('animal_reports', 'date_reported') && 
                    !Schema::hasColumn('animal_reports', 'date_found')) {
                    $table->renameColumn('date_reported', 'date_found');
                }
            });
        }
    }
};
