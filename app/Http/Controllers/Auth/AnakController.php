<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnakController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (! $user->isPelanggan()) {
            return redirect()->route('pageHome');
        }

        $anaks = $user->anaks()->latest()->get();

        return view('anak.index', compact('anaks'));
    }

    public function setup()
    {
        $user = Auth::user();

        if (! $user->isPelanggan()) {
            return redirect()->route('pageHome');
        }

        $anaks = $user->anaks()->latest()->get();

        return view('anak.setup', compact('anaks'));
    }

    public function create()
    {
        $user = Auth::user();

        if (! $user->isPelanggan()) {
            return redirect()->route('pageHome');
        }

        return view('anak.form');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ], [
            'nama.required' => 'Nama anak wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);

        Auth::user()->anaks()->create($validated);

        $redirect = $request->input('_from') === 'setup' ? 'anak.setup' : 'anak.index';

        return redirect()->route($redirect)
            ->with('message', 'Data anak berhasil ditambahkan!');
    }

    public function edit(Anak $anak)
    {
        if ($anak->user_id !== Auth::id()) {
            abort(403);
        }

        return view('anak.form', compact('anak'));
    }

    public function update(Request $request, Anak $anak)
    {
        if ($anak->user_id !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'tanggal_lahir' => ['required', 'date', 'before:today'],
            'jenis_kelamin' => ['required', 'in:L,P'],
        ], [
            'nama.required' => 'Nama anak wajib diisi.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'tanggal_lahir.before' => 'Tanggal lahir harus sebelum hari ini.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);

        $anak->update($validated);

        return redirect()->route('anak.index')
            ->with('message', 'Data anak berhasil diperbarui!');
    }

    public function destroy(Anak $anak)
    {
        if ($anak->user_id !== Auth::id()) {
            abort(403);
        }

        $anak->delete();

        return redirect()->route('anak.index')
            ->with('message', 'Data anak berhasil dihapus.');
    }

    public function complete()
    {
        $user = Auth::user();

        if ($user->anaks()->count() === 0) {
            return redirect()->route('anak.setup')
                ->withErrors(['anak' => 'Tambahkan minimal 1 data anak terlebih dahulu.']);
        }

        return redirect()->route('pageHome')
            ->with('message', 'Selamat! Akun Anda sudah siap digunakan.');
    }
}
