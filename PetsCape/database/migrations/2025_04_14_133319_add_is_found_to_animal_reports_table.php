<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('animal_reports', function (Blueprint $table) {
            $table->boolean('is_found')->default(false);
        });
    }

    public function down()
    {
        // Check if the table exists before attempting to modify it
        if (Schema::hasTable('animal_reports')) {
            Schema::table('animal_reports', function (Blueprint $table) {
                $table->dropColumn('is_found');
            });
        }
    }
};