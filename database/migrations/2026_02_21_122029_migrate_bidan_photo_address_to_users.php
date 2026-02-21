<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::table('bidans')
            ->whereNotNull('user_id')
            ->where(function ($q) {
                $q->whereNotNull('photo')
                  ->orWhereNotNull('address')
                  ->orWhereNotNull('latitude')
                  ->orWhereNotNull('longitude');
            })
            ->orderBy('id')
            ->each(function ($bidan) {
                DB::table('users')
                    ->where('id', $bidan->user_id)
                    ->update([
                        'photo' => $bidan->photo,
                        'address' => $bidan->address,
                        'latitude' => $bidan->latitude,
                        'longitude' => $bidan->longitude,
                    ]);
            });
    }

    public function down(): void
    {
        DB::table('bidans')
            ->whereNotNull('user_id')
            ->orderBy('id')
            ->each(function ($bidan) {
                $user = DB::table('users')->where('id', $bidan->user_id)->first();
                if ($user) {
                    DB::table('bidans')
                        ->where('id', $bidan->id)
                        ->update([
                            'photo' => $user->photo,
                            'address' => $user->address,
                            'latitude' => $user->latitude,
                            'longitude' => $user->longitude,
                        ]);
                }
            });
    }
};
