<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('per_page', 10);
        $search = $request->input('search');

        $query = User::where('role', User::ROLE_PELANGGAN)
            ->withCount('anaks')
            ->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('nickname', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }

        $pelanggans = $query->paginate($perPage)->withQueryString();

        return view('admin.pelanggan.index', compact('pelanggans'));
    }

    public function show(User $pelanggan)
    {
        $pelanggan->load('anaks');

        return view('admin.pelanggan.show', compact('pelanggan'));
    }
}
