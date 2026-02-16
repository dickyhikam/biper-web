<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('bidans', function (Blueprint $table) {
            $table->string('employment_type')->default('fulltime')->after('experience_years');
        });
    }

    public function down(): void
    {
        Schema::table('bidans', function (Blueprint $table) {
            $table->dropColumn('employment_type');
        });
    }
};
