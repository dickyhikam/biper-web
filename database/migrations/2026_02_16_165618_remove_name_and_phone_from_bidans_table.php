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
        // Sync existing bidan name/phone to their user records before dropping
        foreach (\App\Models\Bidan::with('user')->whereNotNull('user_id')->get() as $bidan) {
            if ($bidan->user) {
                $bidan->user->update([
                    'name' => $bidan->getAttributes()['name'] ?? $bidan->user->name,
                    'phone' => $bidan->getAttributes()['phone'] ?? $bidan->user->phone,
                ]);
            }
        }

        Schema::table('bidans', function (Blueprint $table) {
            $table->dropColumn(['name', 'phone']);
        });
    }

    public function down(): void
    {
        Schema::table('bidans', function (Blueprint $table) {
            $table->string('name')->after('user_id');
            $table->string('phone')->nullable()->after('specialization');
        });
    }
};
