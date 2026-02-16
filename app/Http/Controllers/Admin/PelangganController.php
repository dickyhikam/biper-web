<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;

class PelangganController extends Controller
{
    public function index()
    {
        $pelanggans = User::where('role', User::ROLE_PELANGGAN)
            ->withCount('anaks')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }
}
